Boekoe adalah aplikasi e-commerce berbasis website yang menjual berbagai jenis buku. Aplikasi ini dibuat dengan bantuan framework Laravel 8.
User membeli buku yang tersedia di website yang mana buku-buku yang tersedia dikelola oleh admin. Untuk bisa membeli buku, user harus memiliki akun terlebih dahulu.

Berikut adalah tahapan yang perlu dilakukan user untuk membeli buku:
User mencari buku yang diinginkan -> User membuka detail buku yang dipilih -> User menentukan jumlah yang diinginkan -> User memasukkan buku ke dalam cart -> User melakukan checkout -> User mengupload bukti transfer berupa foto -> Admin melakukan verifikasi -> Admin mengupdate status buku terus menerus sampai barang sampai di tempat tujuan -> User menerima buku

Ketika pertama kali melaunch website Boekoe, ada beberapa hal yang perlu dipersiapkan terkait dengan database.
-	Create Database
  Database perlu dicreate dengan nama ‘boekoe’.
-	Create Table
  Menjalankan command ‘php artisan migrate:fresh’ pada directory project boekoe.
-	Register Admin
  Registrasi untuk admin bisa dilakukan selayaknya registrasi user biasa. Akan tetapi, ada satu langkah tambahan yang diperlukan yaitu mengubah value pada kolom ‘is_admin’ milik     user admin pada table ‘users’ menjadi 1. Tujuannya adalah untuk menyatakan bahwa user tersebut adalah admin.
