import os # Library untuk berinteraksi dengan sistem operasi (Windows/Linux)

# --- KONFIGURASI AGAR TERMINAL BERSIH ---
# Mematikan log/pesan sampah dari TensorFlow agar terminal enak dibaca
os.environ['TF_ENABLE_ONEDNN_OPTS'] = '0'
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'

# --- IMPORT LIBRARY (ALAT-ALAT YANG DIPAKAI) ---
from fastapi import FastAPI, UploadFile, File # Framework utama untuk membuat Server API
from pydantic import BaseModel # Untuk memvalidasi data yang dikirim user (misal: format chat)
import mysql.connector # Untuk menghubungkan Python ke Database MySQL (XAMPP/Laragon)
import numpy as np # Library matematika canggih untuk mengolah angka/array
from PIL import Image # Library untuk membuka dan mengolah file gambar
from io import BytesIO # Untuk menangani file gambar di memori (RAM)
import ollama # Library untuk mengobrol dengan AI Lokal (Gemma/Llama)

# Library Khusus AI & Pencocokan Teks
from tensorflow.keras.applications.resnet50 import ResNet50, preprocess_input # Model AI untuk melihat gambar
from tensorflow.keras.preprocessing import image as kimage # Alat bantu proses gambar
from tensorflow.keras.models import Model # Struktur dasar model AI
from sklearn.metrics.pairwise import cosine_similarity # Rumus matematika untuk hitung kemiripan gambar
from rapidfuzz import fuzz # Algoritma pintar untuk mencocokkan teks (typo/singkatan)

# --- KONFIGURASI URL LARAVEL ---
# Ini alamat website Laravel Anda. Penting agar AI bisa kasih link yang bisa diklik.
# Jika pakai Laragon Pretty URL: http://toko-furniture.test
# Jika pakai php artisan serve: http://127.0.0.1:8000
BASE_URL_LARAVEL = "http://toko-furniture.test"

# --- 1. INISIALISASI APLIKASI ---
# Membuat aplikasi server
app = FastAPI()

# --- 2. SETUP MODEL AI VISUAL (Mata Komputer) ---
print("Sedang memuat Model AI... (Tunggu sebentar)")
# Kita pakai ResNet50 (Otak yang sudah dilatih melihat jutaan gambar)
base_model = ResNet50(weights='imagenet')
# Kita buang lapisan terakhir (klasifikasi) karena kita cuma butuh "fitur/pola" gambarnya saja
model = Model(inputs=base_model.input, outputs=base_model.get_layer('avg_pool').output)
print("Model AI Visual Siap!")

# --- KONFIGURASI DATABASE ---
# Data login ke database MySQL Anda
db_config = {
    'user': 'root',       # Username default XAMPP/Laragon
    'password': '',       # Password default biasanya kosong
    'host': '127.0.0.1',  # Alamat server database (Localhost)
    'database': 'toko_furniture', # Nama database yang Anda buat
}

# Lokasi folder tempat Laravel menyimpan foto produk (Wajib disesuaikan dengan laptop Anda)
PATH_FOTO_LARAVEL = "C:/laragon/www/toko-furniture/public/storage/foto/"

# --- MODEL DATA INPUT ---
# Aturan: Data chat yang dikirim harus berupa JSON: {"pesan": "teks..."}
class ChatRequest(BaseModel):
    pesan: str

# --- FUNGSI BANTUAN (HELPER) ---
def extract_features(img_data):
    """
    Fungsi ini mengubah GAMBAR menjadi ANGKA (Vector).
    AI tidak mengerti gambar, dia hanya mengerti deretan angka.
    """
    # 1. Buka gambar dan ubah warnanya jadi RGB
    img = Image.open(img_data).convert('RGB')
    # 2. Ubah ukuran jadi 224x224 pixel (Sesuai syarat ResNet50)
    img = img.resize((224, 224))
    # 3. Ubah gambar jadi array angka
    x = kimage.img_to_array(img)
    # 4. Tambah dimensi array (karena AI memproses dalam 'batch')
    x = np.expand_dims(x, axis=0)
    # 5. Sesuaikan format warna agar cocok dengan ResNet50
    x = preprocess_input(x)
    # 6. Minta AI memprediksi/mengekstrak fitur
    features = model.predict(x)
    # 7. Ratakan hasilnya jadi 1 baris angka
    return features.flatten()

# --- ENDPOINT 1: HALAMAN UTAMA ---
@app.get("/")
def home():
    return {"message": "Server Furniture Online + Chatbot Siap!"}

# --- ENDPOINT 2: PENCARIAN TEKS PINTAR (FUZZY SEARCH) ---
@app.get("/search")
def search_products(q: str = ""):
    print(f"\n--- User mencari: '{q}' ---") 

    # Jika user tidak mengetik apa-apa, kembalikan kosong
    if not q: return {"data": []}

    try:
        # 1. Buka koneksi ke database
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor(dictionary=True)

        # 2. Ambil SEMUA data produk
        sql = "SELECT id, nama, slug, harga, gambar_utama, deskripsi, bahan FROM produk"
        cursor.execute(sql)
        all_products = cursor.fetchall()
        
        # 3. Tutup koneksi biar hemat memori
        cursor.close()
        conn.close()

        results = []
        
        # 4. LOGIKA PENCARIAN SAMAR (FUZZY)
        for prod in all_products:
            # Gabungkan teks Nama + Bahan + Deskripsi jadi satu kalimat panjang
            teks_lengkap = f"{prod['nama']} {prod['bahan']} {prod['deskripsi']}"
            
            # Hitung skor kemiripan (0-100) menggunakan algoritma WRatio
            # WRatio pintar menangani typo ("Santuy") dan singkatan
            score = fuzz.WRatio(q, teks_lengkap)
            
            # Jika kemiripan di atas 40%, kita anggap relevan
            if score >= 40:
                prod['score'] = score
                results.append(prod)

        # 5. Urutkan hasil dari skor tertinggi (paling mirip)
        results.sort(key=lambda x: x['score'], reverse=True)

        print(f"HASIL: Ditemukan {len(results)} produk.")
        # Kembalikan 10 produk teratas saja
        return {"data": results[:10]}

    except Exception as e:
        print(f"ERROR: {str(e)}")
        return {"error": str(e)}


# --- ENDPOINT 3: PENCARIAN GAMBAR (VISUAL SEARCH) ---
@app.post("/visual-search")
async def visual_search(file: UploadFile = File(...)):
    try:
        print("\n--- Memulai Visual Search ---")
        
        # 1. Baca gambar yang diupload user
        user_image_content = await file.read()
        # 2. Ubah gambar user jadi ANGKA (Vektor)
        user_vector = extract_features(BytesIO(user_image_content))
        
        # 3. Ambil data produk dari database
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor(dictionary=True)
        cursor.execute("SELECT id, nama, slug, harga, gambar_utama FROM produk")
        products = cursor.fetchall()
        cursor.close()
        conn.close()

        results = []
        # Ubah bentuk array user untuk perhitungan matematika
        user_vector = user_vector.reshape(1, -1)

        # 4. Loop setiap produk di database untuk dibandingkan
        for prod in products:
            # Cek apakah produk punya gambar?
            if not prod['gambar_utama']: continue
            
            # Cari lokasi file gambar di komputer
            full_path = os.path.join(PATH_FOTO_LARAVEL, prod['gambar_utama'])
            
            # Kalau filenya gak ada, lewati
            if not os.path.exists(full_path): continue

            # Buka gambar produk database & ubah jadi ANGKA
            with open(full_path, "rb") as f:
                db_img_vector = extract_features(f)
            
            db_img_vector = db_img_vector.reshape(1, -1)
            
            # 5. HITUNG KEMIRIPAN (Cosine Similarity)
            # Membandingkan seberapa mirip vector user vs vector database
            score = cosine_similarity(user_vector, db_img_vector)[0][0]

            # Jika kemiripan > 50% (0.5), masukkan ke hasil
            if score > 0.5: 
                prod['similarity'] = float(score)
                results.append(prod)

        # 6. Urutkan dari yang paling mirip
        results.sort(key=lambda x: x['similarity'], reverse=True)
        print(f"VISUAL: Ditemukan {len(results)} produk mirip.")
        
        # Kembalikan 5 hasil teratas
        return {"data": results[:5]}
        
    except Exception as e:
        print(f"ERROR Visual: {str(e)}")
        return {"error": str(e)}


# --- ENDPOINT 4: CHATBOT PINTAR (RAG + OLLAMA) ---
@app.post("/chat")
def chat_with_local_ai(request: ChatRequest):
    """
    Logika Chatbot:
    1. Terima pesan user.
    2. Cari produk di database yang mirip dengan pesan user (RAG).
    3. Gabungkan data produk tersebut ke dalam instruksi (Prompt).
    4. Kirim ke Ollama (AI) untuk dijawab.
    """
    print(f"\n--- Chat Masuk: {request.pesan} ---")
    
    try:
        # [LANGKAH 1] Cari Produk yang Relevan di Database
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor(dictionary=True)
        cursor.execute("SELECT id, nama, slug, harga, deskripsi, bahan FROM produk")
        all_products = cursor.fetchall()
        cursor.close()
        conn.close()

        found_products = []
        
        # Loop untuk mencari produk yang teksnya mirip pertanyaan user
        for prod in all_products:
            teks_pencarian = f"{prod['nama']} {prod['bahan']} {prod['deskripsi']}"
            score = fuzz.WRatio(request.pesan, teks_pencarian)
            
            if score > 45: # Jika relevan
                # Buat Link Produk agar bisa diklik di chat
                prod['link'] = f"{BASE_URL_LARAVEL}/produk/{prod['slug']}"
                prod['score'] = score
                found_products.append(prod)

        # Ambil maksimal 3 produk terbaik biar AI tidak bingung
        found_products.sort(key=lambda x: x['score'], reverse=True)
        top_products = found_products[:3]

        # [LANGKAH 2] Susun Data Produk jadi Teks agar AI bisa baca
        context_str = ""
        if top_products:
            context_str = "\n\nDATA PRODUK DARI DATABASE KAMI (Gunakan ini untuk rekomendasi):\n"
            for p in top_products:
                # Format harga jadi Rupiah (contoh: 10000 -> Rp 10.000)
                harga_fmt = "Rp {:,}".format(p['harga']).replace(',', '.')
                # Masukkan data ke string konteks
                context_str += f"- Nama: {p['nama']} | Harga: {harga_fmt} | Link: {p['link']}\n"
        
        # [LANGKAH 3] Buat System Prompt (Instruksi Utama untuk AI)
        # Kita mendikte AI harus bersikap seperti apa
        system_content = (
            "Kamu adalah asisten CS toko 'FurnitureJaya'. Jawablah dengan ramah, sopan, dan singkat. "
            "Jika pertanyaan user berkaitan dengan produk yang ada di DATA PRODUK di bawah, "
            "KAMU WAJIB merekomendasikannya. "
            "Saat merekomendasikan produk, sertakan linknya menggunakan format Markdown: [Nama Produk](Link). "
            "Jangan buat link palsu, gunakan link yang tersedia di data."
            f"{context_str}" # <-- Data produk kita selipkan di sini
        )

        # Susun format pesan untuk Ollama
        messages = [
            {'role': 'system', 'content': system_content}, # Instruksi
            {'role': 'user', 'content': request.pesan}     # Pesan User
        ]
        
        # [LANGKAH 4] Kirim ke Ollama (Proses Berpikir)
        print("AI sedang mencari jawaban...")
        # Pastikan nama model 'gemma2:2b' sesuai dengan yang Anda download di PowerShell
        response = ollama.chat(model='gemma2:2b', messages=messages)
        
        # Ambil jawaban teks dari AI
        bot_reply = response['message']['content']
        print(f"AI Menjawab: {bot_reply[:50]}...")
        
        return {"jawaban": bot_reply}

    except Exception as e:
        error_msg = str(e)
        print(f"ERROR Chatbot: {error_msg}")
        return {"error": f"Gagal memproses Chat: {error_msg}"}