<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara Penggunaan Aplikasi

 Pastikan anda sudah menginstall local web server seperti XAMPP, Laragon dll. Setelah itu clone dari github dan masuk kedalam folder lokasi menggunakan CLI pilihan Anda. selanjutnya ikuti cara berikut: 

 1. `copy .env.example .env` untuk membuat file env berdasarkan file `env.example`
 2. Tambahkan `SANCTUM_STATEFUL_DOMAINS= http://localhost:3000` pada file `.env`
 3. Jalankan perintah `composer install`
 4. Jalankan perintah `php artisan key:generate` untuk meng-genarate key untuk dimasukkan ke `APP_KEY` di file `.env`
 5. Jalankan perintah `php artisan migrate` untuk migrasi database pada laravel
 6. Jalankan perintah `php artisan db:seed` untuk seeding data pada database
 7. Jalankan perintah `php artisan serve` untuk dijalankan di localhost
