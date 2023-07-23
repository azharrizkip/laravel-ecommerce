# Aplikasi Pendataan Produk menggunakan Laravel - Readme

Aplikasi ini adalah sebuah sistem pendataan produk sederhana yang dibangun menggunakan framework Laravel. Aplikasi ini mencakup proses CRUD (Create, Read, Update, Delete) untuk data produk, data pembeli, dan pengguna. Berikut adalah langkah-langkah yang perlu diikuti untuk menjalankan aplikasi ini:

### Prasyarat

Sebelum menjalankan aplikasi, pastikan Anda telah memenuhi prasyarat berikut:

1. PHP (versi 7.4 atau lebih tinggi)
2. Composer
3. MySQL atau database lainnya
4. Laravel (instalasi akan dilakukan melalui Composer)



Langkah-langkah Instalasi
Clone repository ini ke direktori lokal Anda:
bash
Copy code
git clone https://github.com/nama_pengguna/aplikasi-pendataan-produk.git
Masuk ke direktori aplikasi:
bash
Copy code
cd aplikasi-pendataan-produk
Install semua dependensi yang diperlukan menggunakan Composer:
bash
Copy code
composer install
Salin file .env.example menjadi .env:
bash
Copy code
cp .env.example .env
Buatlah database di MySQL untuk aplikasi ini, misalnya dengan nama ecommerce.

Konfigurasi file .env untuk menghubungkan aplikasi ke database yang telah dibuat. Ubah parameter berikut sesuai dengan pengaturan database Anda:

makefile
Copy code
DB_DATABASE=ecommerce
DB_USERNAME=nama_pengguna_database
DB_PASSWORD=password_database
Generate kunci aplikasi:
bash
Copy code
php artisan key:generate
Jalankan migrasi untuk membuat skema tabel di database:
bash
Copy code
php artisan migrate
Jalankan seeder untuk mengisi data pengguna dengan peran (role) "admin", "staff", dan "buyer":
bash
Copy code
php artisan db:seed --class=UsersTableSeeder
Jalankan seeder untuk mengisi data pembeli dan menghubungkannya dengan data pengguna yang memiliki peran (role) "buyer":
bash
Copy code
php artisan db:seed --class=BuyersTableSeeder
Jalankan seeder untuk mengisi data produk:
bash
Copy code
php artisan db:seed --class=ProductsTableSeeder
Menjalankan Aplikasi
Setelah semua langkah instalasi selesai, Anda dapat menjalankan aplikasi menggunakan server lokal Laravel:

bash
Copy code
php artisan serve
Kunjungi alamat http://localhost:8000 di browser Anda untuk mengakses aplikasi.

Fitur Aplikasi
Aplikasi ini memiliki beberapa fitur utama:

Proses CRUD untuk data produk, data pembeli, dan pengguna.
Autentikasi pengguna menggunakan sistem login sebelum dapat menggunakan aplikasi.
Peran (role) pengguna yang membedakan antara admin, staff, dan pembeli.
Pembeli dapat terhubung dengan data pengguna untuk validasi dan manajemen pembelian.
Catatan
Aplikasi ini masih dalam pengembangan dan dapat ditingkatkan lebih lanjut sesuai kebutuhan. Jika Anda menemui masalah atau ingin berkontribusi, silakan buka masalah (issue) atau buat permintaan tarik (pull request) di repositori ini.

Semoga aplikasi ini bermanfaat dan membantu Anda memahami konsep dasar dalam pengembangan aplikasi Laravel. Selamat mencoba!
