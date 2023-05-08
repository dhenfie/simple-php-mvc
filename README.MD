## # Simple PHP MVC Pattern

ini adalah contoh penerapan Design Pattern **MVC** yang di implementasikan di bahasa pemograman PHP.


![alt](https://github.com/dhenfie/simple-php-mvc/php-mvc-login-page.png)

### # Struktur Project

-   public
    -   index.php
-   app

    -   Controllers
    -   Models
    -   View
    -   Support

-   src
    -   Database
    -   Response
    -   Routing
    -   View
-   config
    -   Routes.php
    -   Config.php

### # Apa itu design MVC?

**MVC** atau singkatan dari _Model View Controllers_ adalah design atau arsitektur aplikasi yang memisahkan antara lapisan logika dan tampilan.

pada saat pembuatan web tradisional (non MVC) kita menggabungkan antara lapisan logika dan tampilan dalam satu script / kode. pendekatan ini sangat mudah dalam pengembangan suatu Web, namun sangat susah untuk di maintenance kedepannya apa lagi jika proyek semakain besar.

mempelajari MVC itu sangat berguna apa lagi saat ini banyak sekali framework framework PHP populer seperti Laravel, Symfony yang menggunakan arsitektur MVC.

### # Tentang Project Ini

ini bukan sebuah framework, melainkan contoh penerapan MVC dalam PHP.

Project ini adalah hasil belajar saya dalam mendalami konsep MVC.

dalam project ini juga mengimplementasikan konsep konsep penting seperti **Routing**, **Response** dan juga penggunaan view template engine.

untuk studi kasusnya dalam project ini adalah aplikasi web login sederhana.

### # Konfigurasi dan installasi
setiap konfigurasi di dokumentasikan menggunakan komentar.

file konfigurasi terletak pada folder config pada root project.

terdapat dua file konfigurasi yaitu:

1. Config.php untuk pengaturan database
2. Routes.php untuk pembuatan route

#### # Database
setelah melakukan konfigurasi Database pada Config.php maka selanjutnya adalah mengimport web_login.sql

#### # Menjalankan Aplikasi
untuk menjalankan aplikasi ini dapat menggunakan perintah _composer serve_ untuk memulai server pengembangan.

untuk menguji apakah server berjalan atau tidak, kunjungi http://localhost:8080 di browser.

#### # Informasi User
informasi user login sebagai berikut:

email: john.doe@example.com

password: password
