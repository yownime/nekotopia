# Aplikasi Petshop Nekotopia
_Nekotopia adalah sebuah petshop berbasis ecomerce. Dimana ini memungkinkan untuk mempertemukan penjual dan pembeli, melakukan transaksi, menjual , membeli dan promosi  di dalam satu platform._

[![N|Solid](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)   [![N|Solid](https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white)](https://www.figma.com/) [![N|Solid](https://img.shields.io/badge/Visual_Studio_Code-0078D4?style=for-the-badge&logo=visual%20studio%20code&logoColor=white)](https://code.visualstudio.com//) [![N|Solid](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.12/)


## Features

- product katalog
- Customer Panel
- Seller Panel
- Top, Featured Products
- Product Filter
- Product Discounts
- Coupon Code
- Add to Cart
- Add to Wish List
- Order Tracking System
- View Order
- Rate and Review Products
- Manage Media, Banner
- Product Category Management
- Product Management
- Order Management
- Product Brand and Shipping Management
- Upload Manager: Media Files

## Tech

Nekotopia di build menggunakan:

- [Laravel](https://laravel.com/) - Laravel adalah kerangka kerja aplikasi web berbasis PHP yang sumber terbuka, menggunakan konsep Model-View-Controller. Laravel berada dibawah lisensi MIT, dengan menggunakan GitHub sebagai tempat berbagi kode.
- [Visual Studio Code](https://code.visualstudio.com//) - Visual Studio Code adalah perangkat lunak penyunting kode-sumber buatan Microsoft untuk Linux, macOS, dan Windows. Visual Studio Code menyediakan fitur seperti penyorotan sintaksis, penyelesaian kode, kutipan kode, merefaktor kode, pengawakutuan, dan Git.
- [XAMPP](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.12/) - XAMPP adalah perangkat lunak bebas, yang mendukung banyak sistem operasi, merupakan kompilasi dari beberapa program. 
- [HTML] - HyperText Markup Language adalah bahasa markah standar untuk dokumen yang dirancang untuk ditampilkan di peramban internet.
- [CSS] - Cascading Style Sheet merupakan aturan untuk mengatur beberapa komponen dalam sebuah web sehingga akan lebih terstruktur dan seragam. 
- [PHP] - PHP: Hypertext Preprocessor atau hanya PHP saja, adalah bahasa skrip dengan fungsi umum yang terutama digunakan untuk pengembangan web. 
- [JS] - JavaScript adalah suatu bahasa pemrograman tingkat tinggi dan dinamis.

## Installation

- Requires [XAMPP](https://nodejs.org/) Version: 7.4.12 to run.
- Composer
- Laravel >= 8


Install the dependencies and devDependencies and start XAMPP server.

or u can just clone this repository.

```sh
git clone https://github.com/yownime/nekotopia.git
```

```sh
cd nekotopia
```
Install dependencies
```sh
composer install
npm install
```
Link the Storage
```sh
cd public
rmdir storage
cd..
php artisan storage:link
```
Migrate and Seed Database
```sh
php artisan migrate --seed
```
generate the key
```sh
php artisan key:generate
```
run the project
```sh
php artisan serve
```

