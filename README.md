<div align="center">
  
# BeasiswaKu
  
<!-- Ganti "logo.png" di bawah ini dengan nama file gambar logo aslimu yang ada di folder -->
<img src="logo-BeasiswaKu.png" alt="Logo BeasiswaKu" width="450">

</div>

<br>

**Kelompok** : 3  
**Kelas**&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: XI PPLG 5  
**Anggota**&nbsp;&nbsp;&nbsp;:  
1. Kamila Mahda Fiqiyah (14)
2. Krisna Rizky Saputra (17)
3. Mischa Riyumi Wirya (19)
4. M. Erlano Fadel Hidayat (22)
5. Saladin Octiano Bonanza (32)

---
**Platform informasi beasiswa terintegrasi untuk pelajar dan mahasiswa.**

## 📖 Deskripsi Aplikasi
BeasiswaKu adalah platform informasi beasiswa akurat yang menyediakan daftar program dalam dan luar negeri, panduan pendaftaran, hingga tips seleksi. Kami hadir untuk membantu pelajar dan mahasiswa memaksimalkan peluang pendidikan melalui akses informasi yang jelas dan terintegrasi.

## 👥 Nama Anggota & Pembagian Tugas

| No | Nama Lengkap | No. Absen | Role Anggota | Pembagian Tugas |
|:---:|---|:---:|---|---|
| 1 | **Kamila Mahda Fiqiyah** | 14 | UI/UX | Desainer UI/UX Figma, Poster aplikasi, Endpoint search, dan filter query. |
| 2 | **Krisna Rizky Saputra** | 17 | Database | Database, menambahkan data-data beasiswa, Endpoint filter beasiswa yang sedang populer. |
| 3 | **Mischa Riyumi Wirya** | 19 | UI/UX | Desainer UI/UX Figma, Poster aplikasi, Endpoint lupa password dan reset password. |
| 4 | **Muhammad Erlano Fadel Hidayat** | 22 | Database | Database, menambahkan data-data artikel, Endpoint list artikel / Tips & Trik. |
| 5 | **Saladin Octiano Bonanza** | 32 | API & Android Dev | API dan Android dev, menghubungkan API consume Laravel dengan Android (Jetpack Compose), Endpoint Auth Sanctum (User/Admin), list beasiswa, testimoni, beasiswa tersimpan, dan notifikasi. |

## ✨ Fitur Utama Aplikasi
* **Autentikasi Aman:** Sistem Login dan Register yang dienkripsi menggunakan Laravel Sanctum.
* **Pencarian & Filter:** Pengguna dapat mencari beasiswa impian dan memfilternya berdasarkan kategori (Pemerintah, Swasta, Kampus).
* **Trending & Tips:** Menampilkan daftar beasiswa yang sedang populer dan korsel artikel panduan/tips seleksi.
* **Wishlist (Simpan Beasiswa):** Pengguna dapat menyimpan beasiswa favorit ke dalam daftar tersimpan.
* **Manajemen Admin:** Fitur khusus admin (CRUD) untuk mengedit dan menghapus data beasiswa langsung dari dalam aplikasi mobile.
* **Push Notification:** Sistem notifikasi yang terintegrasi dengan Firebase Cloud Messaging (FCM).

## 🛠️ Tech Stack & Arsitektur

**MOBILE CLIENT (Android) :**
* **Bahasa Pemrograman:** Kotlin (v1.9.22)
* **UI Toolkit:** Jetpack Compose (BOM v2024.02.00)
* **Networking / API Client:** Retrofit (v2.9.0) & OkHttp (v4.11.0)
* **Image Loading:** Coil (v2.6.0)
* **Asynchronous Programming:** Kotlin Coroutines & Flow
* **Notifikasi:** Firebase SDK & Cloud Messaging (FCM)

**BACKEND API :**
* **Framework:** Laravel (v10.x)
* **Bahasa Pemrograman:** PHP (v8.2.x)
* **Database:** MySQL (v8.0.x)
* **Autentikasi:** Laravel Sanctum
* **Arsitektur:** RESTful API

## 📦 Link Repository & Hasil Build APK

Silakan akses *source code* murni dan hasil kompilasi aplikasi siap install melalui tautan resmi di bawah ini:

* **Link Repository Backend (API Laravel):**  
  `https://github.com/Saladin2510/BeasiswaKu-API-Laravel` ([*https://github.com/Saladin2510/BeasiswaKu-API-Laravel*](https://github.com/Saladin2510/BeasiswaKu-API-Laravel))

* **Link Repository Android App (Kotlin):**  
  `https://github.com/Saladin2510/BeasiswaKu-Jetpack` ([*https://github.com/Saladin2510/BeasiswaKu-Jetpack*](https://github.com/Saladin2510/BeasiswaKu-Jetpack))

* **Link Download APK Aplikasi (Siap Pakai):**  
  `https://drive.google.com/file/d/1ST3XwYMqWae1XdXhAyVBWpzGd2EmI4aj/view?usp=drive_link` ([*https://drive.google.com/file/d/1ST3XwYMqWae1XdXhAyVBWpzGd2EmI4aj/view?usp=drive_link*](https://drive.google.com/file/d/1ST3XwYMqWae1XdXhAyVBWpzGd2EmI4aj/view?usp=drive_link))

> **📝 CATATAN PENTING MENGENAI HASIL BUILD APK:**  
> Proyek ini saat ini masih menggunakan arsitektur *Client-Server* berbasis jaringan lokal (*localhost* / *tethering hotspot*). Bagian *Backend API* (Laravel) dan *Database* (MySQL) masih berjalan di perangkat komputer pengembang (Local Environment), belum di-*deploy* ke server publik (*Hosting/VPS*). 
> 
> Oleh karena itu, file `.apk` yang dilampirkan adalah versi *Debug* di mana URL API-nya diarahkan secara spesifik ke IP lokal perangkat pengembang untuk keperluan demonstrasi/presentasi. Aplikasi ini belum bisa memuat data secara mandiri apabila diinstal oleh pengguna di luar jaringan lokal (*Tethering*) yang kami gunakan.
