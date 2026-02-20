# 🛋️ FurnitureJaya - AI-Powered E-Commerce

Sebuah platform e-commerce furnitur modern yang dilengkapi dengan Kecerdasan Buatan (AI) terintegrasi. Proyek ini dibangun sebagai eksplorasi integrasi antara **PHP (Laravel)** sebagai *core backend* & *frontend*, dengan **Python (FastAPI)** sebagai *microservice* untuk pemrosesan AI secara lokal tanpa API berbayar.

## ✨ Fitur Unggulan (Key Features)

* 🤖 **Local AI Chatbot (RAG System):** Asisten Customer Service cerdas yang berjalan sepenuhnya secara lokal menggunakan **Ollama (Gemma 2)**. AI dapat merekomendasikan produk dengan memberikan tautan langsung berdasarkan data katalog di *database*.
* 🔍 **Smart Search (Fuzzy Logic):** Mesin pencari tahan *typo* (salah ketik) menggunakan algoritma WRatio (`rapidfuzz`). Pencarian "kurs" atau "sofa santuy" akan tetap menemukan produk "Kursi" dan "Sofa Santai".
* 📸 **Visual Search Engine:** Pengguna dapat mengunggah foto furnitur, dan sistem akan mencari produk dengan bentuk/warna paling mirip menggunakan model AI **ResNet50** (Cosine Similarity).
* 📐 **Interactive Room Planner:** Fitur *drag-and-drop* interaktif menggunakan **React.js** di mana pengguna dapat mensimulasikan penempatan furnitur di ruangan virtual beserta kalkulasi harga otomatis.

## 🛠️ Teknologi yang Digunakan (Tech Stack)

**Web Core:**
* [Laravel 11] - PHP Framework
* [Livewire] - Untuk interaktivitas komponen (Chatbot Widget)
* [React.js] - Untuk Room Planner interactive canvas
* [Tailwind CSS / Bootstrap] - Styling
* [MySQL] - Relational Database

**AI & Microservice:**
* [Python 3] - AI Processing
* [FastAPI] - High-performance API framework penghubung Python & Laravel
* [Ollama] - Local LLM Engine (Model: `gemma2:2b`)
* [TensorFlow & Keras] - Ekstraksi fitur visual (ResNet50)
* [RapidFuzz] - String matching / Typo tolerance

## ⚙️ Cara Instalasi (Local Setup)

Karena proyek ini menggunakan arsitektur *microservice* (Laravel + Python), ikuti langkah berikut untuk menjalankannya di komputer lokal:

### 1. Setup Web App (Laravel)
```bash
git clone [https://github.com/](https://github.com/)[KevinThenadi]/[toko-Furniture].git
cd [toko-Furniture]
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve