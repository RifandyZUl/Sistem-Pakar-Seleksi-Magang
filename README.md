📋 Deskripsi Singkat
Sistem ini merupakan aplikasi berbasis web yang digunakan untuk melakukan seleksi dan pemeringkatan calon karyawan menggunakan dua metode pengambilan keputusan multikriteria:

**Weighted Product (WP)**
**VIKOR**

Sistem ini dirancang untuk digunakan oleh dua jenis pengguna:

**Admin: mengelola kriteria penilaian dan melihat hasil perhitungan.**
**HRD: menginput alternatif (kandidat) dan memberikan nilai berdasarkan kriteria.**

⚙️ Teknologi yang Digunakan
Laravel 12.x (Backend Framework)

Breeze (Authentication)

Tailwind CSS (Frontend styling)

Node.js + NPM (Frontend dependencies)

DomPDF (Export hasil ke PDF)

MySQL / MariaDB (Database)

 Cara Menjalankan Aplikasi
Clone repo ini

bash
Salin
Edit
git clone https://github.com/username/nama-project.git
cd nama-project
Install dependency backend

bash
Salin
Edit
composer install
Install dependency frontend

bash
Salin
Edit
npm install
npm run build
Setup file .env

bash
Salin
Edit
cp .env.example .env
Edit konfigurasi database di file .env.

Generate key dan migrasi database

bash
Salin
Edit
php artisan key:generate
php artisan migrate --seed
Jalankan server

bash
Salin
Edit
php artisan serve
🔐 Role & Akses
Role	Hak Akses
Admin	Kelola kriteria, lihat hasil
HRD	Input data alternatif & nilai

📄 Fitur Utama
CRUD Kriteria (Admin)

Input Alternatif dan Nilai (HRD)

Perhitungan dan Ranking Metode WP & VIKOR

Export hasil ke PDF

Autentikasi dengan Laravel Breeze

📎 License
Proyek ini menggunakan MIT License
