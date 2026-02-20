import os

# Base folder project Anda (Sesuai screenshot)
PROJECT_DIR = "C:/laragon/www/toko-furniture"

# Daftar tempat persembunyian yang mungkin
kemungkinan_path = [
    "storage/app/public/foto",  # Standar Laravel
    "public/storage/foto",      # Folder Public langsung
    "public/foto",              # Kadang orang taruh sini
    "storage/foto"
]

print("--- MULAI PENCARIAN FILE ---")
found = False

# Kita cari file 'kursi1.jpeg' atau 'meja1.jpeg' sebagai sampel
target_files = ["kursi1.jpeg", "meja1.jpeg", "lemari1.jpeg"]

for subpath in kemungkinan_path:
    full_path = os.path.join(PROJECT_DIR, subpath)
    print(f"\n[?] Mengecek folder: {full_path}")
    
    if os.path.exists(full_path):
        isi_folder = os.listdir(full_path)
        print(f"    -> Folder ADA. Isinya {len(isi_folder)} file.")
        
        # Cek apakah ada file target kita?
        ketemu_target = any(f in isi_folder for f in target_files)
        
        if ketemu_target:
            print("\n" + "="*40)
            print("🎉 HARTA KARUN DITEMUKAN DI SINI! 🎉")
            print("="*40)
            print(f"Gunakan Path ini di main.py Anda:")
            # Ubah backslash jadi slash agar aman di Python
            clean_path = full_path.replace("\\", "/") + "/"
            print(f"PATH_FOTO_LARAVEL = \"{clean_path}\"")
            found = True
            break
        else:
             print("    -> Tapi file produk (kursi1/meja1) TIDAK ADA di sini.")
    else:
        print("    -> Folder TIDAK ADA.")

if not found:
    print("\n--- GAGAL TOTAL ---")
    print("Coba buka File Explorer, cari 'kursi1.jpeg' ada di folder mana?")