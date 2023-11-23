# IF3110 Pengembangan Aplikasi Berbasis Web (Jahitin App)

## Table of Contents
* [Description](#description)
* [Requirements](#requirements)
* [How To Install](#how-to-install)
* [How To Run](#how-to-run)
* [Screenshots](#screenshots)
* [Authors](#authors)
* [LightHouse Score](#lighthouse-score)

## Description
Aplikasi ini merupakan aplikasi berbasis web yang memiliki fungsionalitas utama, melakukan pencarian dan menampilkan list penjahit beserta karya dan review-nya. Pembuatan aplikasi ini melibatkan beberapa bahasa pemrograman tanpa bergantung pada library eksternal. Bahasa dan tools yang digunakan termasuk JavaScript, HTML, dan CSS untuk sisi klien, PHP untuk sisi server, serta MySQL untuk menyimpan basis data.
Berikut adalah halaman-halaman yang tersedia dalam aplikasi ini:
   * Login
   * Register
   * Homepage User (Search by keyword, filter, sort, and pagination)
   * Homepage Admin (Search by keyword, filter, sort, and pagination)
   * User Profile
   * Tailor's Review
   * Update Tailor's Review
   * Add Tailor's Review
   * Add Tailor
   * Update Tailor
   * Manage User

## Requirements
Untuk menjalankan program pastikan Anda telah mendownload dan menginstall hal-hal berikut:
1. Teks Editor
2. JavaScript
3. XAMPP
4. MySQL
5. Docker

## How To Install
1. Teks Editor yang kami sarankan adalah Visual Studio Code yang panduan download dan installnya dapat dilihat pada tautan berikut ini [vscode](https://code.visualstudio.com/docs/setup/setup-overview)
2. Panduan instalasi JavaScript dapat dilihat pada tautan berikut [JS](https://launchschool.com/books/javascript/read/preparations)
3. Panduan instalasi XAMPP dapat dilihat pada tautan berikut [XAMPP](https://www.ionos.com/digitalguide/server/tools/xampp-tutorial-create-your-own-local-test-server/)
4. Panduan instalasi MySQL dapat dilihat pada tautan berikut [MySQL](https://www.javatpoint.com/how-to-install-mysql#:~:text=Step%201%3A%20Go%20to%20the,community%20server%2C%20which%20you%20want.)
4. Panduan instalasi Docker dapat dilihat pada tautan berikut [Docker](https://docs.docker.com/desktop/install/windows-install/)


## How To Run
1. Run with XAMPP
    1. Download dan unzip terlebih dahulu repository ini pada folder htdocs yang berada di dalam folder XAMPP.
    2. Selanjutnya jalankan link berikut ini pada browser di komputer Anda (localhost/tugas-besar-1). 
    3. Lalu, download database *jahitin.sql* pada folder database dan import pada XAMPP. 
    4. Sesuaikan database pada file config.php dengan username dan password XAMPP Anda.

2. Run with Docker
    1. Download dan unzip terlebih dahulu repository ini
    2. Clone repo
    ```sh
    git clone git@gitlab.informatika.org:if3110-2023-01-g/tugas-besar-1.git
    ```
    3. Pastikan terminal berada pada directory program, jika belum:
    ```sh
    cd <path repo>
    ```
    4. Untuk Windows
    Lakukan 
    ```sh
     docker compose build
     ```
     Lalu,
     ```sh
     docker-compose up
     ```
    5. Untuk Mac
    Copy path program ke settings -> file sharing pada docker desktop
    Lakukan 
    ```sh
     docker compose build
     ```
     Lalu,
     ```sh
     docker-compose up
     ```
    6. Masukkan "localhost" pada browser Anda.
    7. Role as User,
    username: satuk
    password: 123123qw
    8. Role as Admin,
    username: admin
    password: admin

## Screenshots
1. Halaman Login 
    ---
    <img src="screenshot/login-page.png" style="width: 500px" />
2. Halaman Register 
    ---
    <img src="screenshot/register-page.png" style="width: 500px"/>
3. Halaman Homepage User 
    ---
    <img src="screenshot/homepage-user.png" style="width: 500px"/>
4. Halaman Homepage Admin 
    ---
    <img src="screenshot/homepage-admin.png" style="width: 500px"/>
5. Halaman User Profile 
    ---
    <img src="screenshot/user-profile.png" style="width: 500px"/>
6. Halaman Tailor's Review 
    ---
    <img src="screenshot/tailor-review.png" style="width: 500px"/>
7. Halaman Update Tailor's Review 
    ---
    <img src="screenshot/update-review.png" style="width: 500px"/>
8. Halaman Add Tailor's Review 
    ---
    <img src="screenshot/add-review.png" style="width: 500px"/>
9. Halaman Add Tailor 
    ---
    <img src="screenshot/add-tailor.png" style="width: 500px"/>
10. Halaman Update Tailor 
    ---
    <img src="screenshot/update-tailor.png" style="width: 500px"/>
11. Halaman Manage User 
    ---
    <img src="screenshot/manage-user.png" style="width: 500px"/>
12. Pagination
    ---
    <img src="screenshot/pagination.png" style="width: 500px"/>

## Authors
1. Client-Side

|feature|13521010|13521030|
|-------|--------|--------|
|Login|✔️|✔️|
|Register|✔️|✔️|
|Homepage User|✔️|✔️|
|Homepage Admin|✔️|✔️|
|User Profile|✔️|✔️|
|Tailor's Review|✔️|✔️|
|Update Tailor's Review|✔️|✔️|
|Add Tailor's Review|✔️|✔️|
|Add Tailor|✔️|✔️|
|Update Tailor|✔️|✔️|
|Manage User|✔️|✔️|

2. Server-Side

|feature|13521010|13521030|
|-------|--------|--------|
|Login|✔️|✔️|
|Register|✔️|✔️|
|Homepage User|✔️|✔️|
|Homepage Admin|✔️|✔️|
|User Profile|✔️|✔️|
|Tailor's Review|✔️|✔️|
|Update Tailor's Review|✔️|✔️|
|Add Tailor's Review|✔️|✔️|
|Add Tailor|✔️|✔️|
|Update Tailor|✔️|✔️|
|Manage User|✔️|✔️|

## LightHouse Score
1. LightHouse Score Login Page
    ---
    <img src="screenshot/lighthouseLogin.png" style="width: 500px" />
2. LightHouse Score Register Page
    ---
    <img src="screenshot/lighthouseRegister.png" style="width: 500px"/>
3. LightHouse Score Homepage User
    ---
    <img src="screenshot/lighthouseHomepageUser.png" style="width: 500px"/>
4. LightHouse Score Homepage Admin
    ---
    <img src="screenshot/lighthouseHomepageAdmin.png" style="width: 500px"/>
5. LightHouse Score Profile Page
    ---
    <img src="screenshot/lighthouseProfilPage.png" style="width: 500px"/>
6. LightHouse Score Tailor's Review Page
    ---
    <img src="screenshot/lighthouseReviewTailor.png" style="width: 500px"/>
7. LightHouse Score Add Tailor's Review Page
    ---
    <img src="screenshot/lighthouseAddReviewTailor.png" style="width: 500px"/>
8. LightHouse Score Update Tailor's Review Page
    ---
    <img src="screenshot/lighthouseUpdateReview.png" style="width: 500px"/>
9. LightHouse Score Add Tailor Page
    ---
    <img src="screenshot/lighthouseAddTailor.png" style="width: 500px"/>
10. LightHouse Score Update Tailor Page
    ---
    <img src="screenshot/lighthouseUpdateTailor.png" style="width: 500px"/>