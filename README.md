# Aplikasi PPDB SMK Terpadu Ad-Dimyati

## Deskripsi
Aplikasi PPDB SMK Terpadu Ad-Dimyati adalah sebuah aplikasi berbasis web yang dirancang khusus untuk mengelola proses Penerimaan Peserta Didik Baru (PPDB) di SMK Terpadu Ad-Dimyati. Aplikasi ini dibangun menggunakan kerangka kerja Laravel, yang memungkinkan pengguna untuk melakukan pendaftaran siswa baru secara online dan efisien, serta mengelola semua tahapan dalam proses PPDB.

## Fitur Utama
Aplikasi PPDB SMK Terpadu Ad-Dimyati memiliki sejumlah fitur utama yang mendukung seluruh proses penerimaan siswa baru:
#### 1. Pendaftaran Siswa Baru 
- Calon siswa dapat mengisi formulir pendaftaran secara online melalui antarmuka yang mudah digunakan.
- Informasi pribadi, riwayat pendidikan, dan data lainnya dapat diunggah dan disimpan.
- Penggunaan voucher dan keringanan lainnya

#### 2. Pembayaran Administrasi
- Siswa yang diterima dapat melakukan pembayaran administrasi pendaftaran melalui metode pembayaran yang telah ditentukan.

#### 3. Export laporan
- Admin dan staf dapat meng export data pendaftaran ke format excel, utuk lebih memudahkan pendokumentasian jika ingin di lakukan print out

#### 4. Monitoring Proses
- Admin dan staf sekolah dapat memantau seluruh proses PPDB, termasuk status pendaftaran, seleksi, dan pembayaran.

## Instalasi saat pengembangan
Langkah-langkah instalasi aplikasi ini:

1. Clone repositori dari GitHub:

   ```bash
   git clone https://github.com/Giafn/ppdb-addimyati.git
   ```

2. Masuk ke direktori proyek:

   ```bash
   cd ppdb-addimyati
   ```

3. Salin file `.env.example` menjadi `.env` dan konfigurasikan variabel-variabel lingkungan (environment variables).

4. Install dependensi PHP dengan Composer:

   ```bash
   composer install
   ```

5. Generate kunci aplikasi:

   ```bash
   php artisan key:generate
   ```

6. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```
7. Install package npm

   ```bash
   npm install
   ```
8. Compile css setiap ada perubahan:

   ```bash
   npm run watch
   ```
   
9. Jalankan aplikasi Laravel:

   ```bash
   php artisan serve
   ```

Aplikasi akan dijalankan di `http://localhost:8000`.


## Catatan Rilis
Aplikasi masih tahap pengembangan

## Kontak
jika ada yang ingin di tanyakan tentang aplikasi ini hubungi email `giafauzan11@gmail.com`
