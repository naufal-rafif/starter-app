# Panduan Instalasi Laravel dengan Laragon

## Daftar Isi
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi Laragon](#instalasi-laragon)
- [Menambahkan PHP 8.2](#menambahkan-php-82)
- [Konfigurasi Path Windows](#konfigurasi-path-windows)
- [Verifikasi Instalasi](#verifikasi-instalasi)

## Persyaratan Sistem
- Windows 7 atau lebih tinggi (Windows 10/11 direkomendasikan)
- Minimal RAM 4GB
- Ruang disk minimal 1GB
- Koneksi internet untuk mengunduh komponen

## Instalasi Laragon

1. Unduh Laragon dari situs resmi:
   - Kunjungi [https://laragon.org/download/](https://laragon.org/download/)
   - Pilih versi "Laragon Full"

2. Jalankan installer Laragon:
   - Klik kanan pada file installer -> Run as Administrator
   - Ikuti wizard instalasi
   - Lokasi instalasi default: `C:\laragon`

3. Komponen yang terinstal otomatis:
   - Apache
   - MySQL
   - PHP (versi default)
   - Composer
   - Git
   - Node.js & npm

## Menambahkan PHP 8.2

1. Unduh PHP 8.2:
   - Kunjungi [https://windows.php.net/download/](https://windows.php.net/download/)
   - Pilih "VS16 x64 Thread Safe"
   - Unduh file zip PHP 8.2.x

2. Instalasi PHP 8.2:
   ```
   - Buat folder baru: C:\laragon\bin\php\php-8.2.x
   - Ekstrak file zip PHP ke folder tersebut
   ```

## Verifikasi Instalasi

1. Buka Command Prompt dan jalankan perintah berikut:
   ```bash
   php -v    # Mengecek versi PHP
   node -v   # Mengecek versi Node.js
   npm -v    # Mengecek versi NPM
   composer -v # Mengecek versi Composer
   ```

2. Setelah semua terinstal, restart Laragon:
   - Klik kanan pada icon Laragon di system tray
   - Pilih "Exit"
   - Buka kembali Laragon

3. Mengecek Laravel:
   ```bash
   composer create-project laravel/laravel example-app
   cd example-app
   php artisan serve
   ```

## Instalasi Visual Studio Code

4. Extension Tambahan yang Berguna:
   - Material Icon Theme (PKief.material-icon-theme)
   - Error Lens (usernamehw.errorlens)
   - Auto Close Tag (formulahendry.auto-close-tag)
   - Auto Rename Tag (formulahendry.auto-rename-tag)
   - DotENV (mikestead.dotenv)
   - PHP DocBlocker (neilbrayfield.php-docblocker)
   - Tailwind CSS IntelliSense (bradlc.vscode-tailwindcss)

## Troubleshooting

1. Jika PHP tidak terdeteksi:
   - Pastikan path PHP sudah benar di Environment Variables
   - Restart Command Prompt/Terminal
   - Restart Laragon

2. Jika Node.js tidak terdeteksi:
   - Verifikasi instalasi Node.js di Control Panel
   - Pastikan path Node.js sudah benar
   - Restart sistem jika diperlukan

3. Jika Composer gagal:
   - Pastikan PHP terinstal dengan benar
   - Jalankan `composer diagnose`
   - Update Composer dengan `composer self-update`

## Integrasi Tailwind CSS

1. Instalasi Tailwind CSS:
   ```bash
   # Masuk ke direktori proyek Laravel
   cd nama-proyek

   # Install Tailwind CSS dan dependensi yang diperlukan
   npm install -D tailwindcss@latest postcss@latest autoprefixer@latest

   # Generate file konfigurasi Tailwind
   npx tailwindcss init -p
   ```

2. Konfigurasi Tailwind CSS:
   - Buka file `tailwind.config.js` dan update konfigurasi:
   ```javascript
   /** @type {import('tailwindcss').Config} */
   module.exports = {
     content: [
       "./resources/**/*.blade.php",
       "./resources/**/*.js",
       "./resources/**/*.vue",
     ],
     theme: {
       extend: {},
     },
     plugins: [],
   }
   ```

3. Update File CSS:
   - Buka atau buat file `resources/css/app.css`
   - Tambahkan direktif Tailwind:
   ```css
   @tailwind base;
   @tailwind components;
   @tailwind utilities;

   /* Custom styles bisa ditambahkan di bawah */
   ```

4. Update File view/layout:
   - Buka file template blade utama (misalnya `resources/views/layouts/app.blade.php`)
   - Tambahkan referensi ke CSS:
   ```html
   <!DOCTYPE html>
   <html>
   <head>
       <!-- ... other tags ... -->
       @vite('resources/css/app.css')
   </head>
   <body>
       <!-- content -->
   </body>
   </html>
   ```

5. Konfigurasi Vite:
   - Buka file `vite.config.js`
   - Pastikan konfigurasi seperti ini:
   ```javascript
   import { defineConfig } from 'vite';
   import laravel from 'laravel-vite-plugin';

   export default defineConfig({
       plugins: [
           laravel({
               input: ['resources/css/app.css', 'resources/js/app.js'],
               refresh: true,
           }),
       ],
   });
   ```

6. Jalankan Development Server:
   ```bash
   # Terminal 1: Jalankan Laravel
   php artisan serve

   # Terminal 2: Jalankan Vite untuk compile assets
   npm run dev
   ```

7. Contoh Penggunaan Tailwind:
   ```html
   <!-- resources/views/welcome.blade.php -->
   <div class="container mx-auto px-4">
       <h1 class="text-3xl font-bold text-gray-800 mb-4">
           Welcome to Laravel with Tailwind
       </h1>
       <p class="text-gray-600">
           This is a sample page using Tailwind CSS
       </p>
   </div>
   ```

8. Tips Penggunaan Tailwind:
   - Gunakan extension VS Code "Tailwind CSS IntelliSense" untuk autocomplete
   - Manfaatkan fitur Just-in-Time Mode yang sudah aktif by default
   - Untuk production, jangan lupa build assets:
     ```bash
     npm run build
     ```

9. Kustomisasi Tailwind (Opsional):
   - Extend theme di `tailwind.config.js`:
   ```javascript
   module.exports = {
     theme: {
       extend: {
         colors: {
           'primary': '#FF6B6B',
           'secondary': '#4ECDC4',
         },
         fontFamily: {
           'sans': ['Poppins', 'sans-serif'],
         },
       },
     },
   }
   ```

10. Troubleshooting Tailwind:
    - Jika classes tidak tercompile:
      - Pastikan path di `content` pada `tailwind.config.js` benar
      - Clear cache: `php artisan optimize:clear`
      - Restart Vite: `npm run dev`
    
    - Jika styling tidak muncul:
      - Periksa browser console untuk error
      - Pastikan Vite running (`npm run dev`)
      - Periksa file CSS sudah di-import dengan benar