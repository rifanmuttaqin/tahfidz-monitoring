INSTALASI TAHFIDZ MONITORING 

- Persiapkan Xampp / Aplikasi Local Server Sejenis
- Install Composer, Download di https://getcomposer.org/
- Restart komputer jika selesai instalasi jika perlu
- Masuk ke direktori program tahfidz monitoring
- Lakukan perintah pada cmd. composer update
- Copy .env.example dan buat file pada direktori yang sama .env
- Masih pada file .env file yang baru, ganti DB_DATABASE isi dengan tahfidz DB_USERNAME isi dengan root DB_PASSWORD kosongkan | (atau sesuaikan dengan xampp anda) 
- Buka CMD masuk ke direktori tahfidz ketikkan perintah = php artisan tahfidz:setup

INSTALASI PADA TAHAP INI SELESAI

CARA PENGAKSESAN

- masih pada cmd di direktori tahfidz ketikan perintah php artisan serve
- Akses 127.0.0.1:8000
- Masukkan user admin password Jember123 (USER LEVEL CREATOR)
- Gunakan dengan bijak


--------------------
Level Admin :

- Lever Creator (username : admin pass:Jember123)
- Level Admin
- Level Guru

- Creator bebas akses keseluruh fitur di sistem
- Admin Hampir sama dengan Creator namun tdk bisa melakukan penilaian
- Guru ( Melakukan Penilaian )

BUG Laporkan ke :
rifanmuttaqin@gmail.com