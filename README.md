# 🚀 UAS API - Machine to Machine (M2M) Authentication

API untuk Ujian Akhir Semester - Pengembangan Aplikasi Bisnis menggunakan Laravel 11 dengan OAuth2 Client Credentials Grant (M2M/H2H)

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 📋 Deskripsi Project

Aplikasi REST API yang mengimplementasikan **Machine to Machine (M2M)** dan **Host to Host (H2H)** authentication menggunakan **Laravel Passport Client Credentials Grant**. API ini menyediakan 8 endpoint untuk layanan umum dan data pasar saham.

### Fitur Utama

- ✅ **Laravel 11** - Framework PHP terbaru
- ✅ **Laravel Passport** - OAuth2 Server Implementation
- ✅ **Client Credentials Grant** - M2M/H2H Authentication
- ✅ **8 API Endpoints** - General Services & Stock Market
- ✅ **Swagger UI** - Interactive API Documentation
- ✅ **JWT Token** - Secure Bearer Token Authentication

---

## 🎯 API Endpoints

### 📂 General Services (4 Endpoints)

| Method | Endpoint | Deskripsi | Parameter |
|--------|----------|-----------|-----------|
| `GET` | `/api/weather` | Mendapatkan informasi cuaca | `city` (required) |
| `GET` | `/api/currency` | Mendapatkan nilai tukar mata uang | `from`, `to` (required) |
| `GET` | `/api/news` | Mendapatkan artikel berita | `category` (required) |
| `POST` | `/api/data` | Mengirim data payload | JSON body |

### 📈 Stock Market (4 Endpoints)

| Method | Endpoint | Deskripsi | Parameter |
|--------|----------|-----------|-----------|
| `GET` | `/api/stock/price` | Mendapatkan harga saham | `symbol` (required) |
| `GET` | `/api/stock/profile` | Mendapatkan profil perusahaan | `symbol` (required) |
| `GET` | `/api/stock/historical` | Mendapatkan data historis saham | `symbol`, `from`, `to` |
| `GET` | `/api/stock/movers` | Mendapatkan saham teratas | `type` (gainers/losers) |

---

## 📖 Dokumentasi API

Akses **Swagger UI** untuk dokumentasi interaktif:

http://localhost:8000/api/documentation

**Fitur Swagger UI:**
- 🔐 Authorize dengan Bearer Token
- 🧪 Try It Out untuk test endpoint langsung
- 📋 Request/Response schema lengkap
- 📝 Parameter description

---

## 🔑 Authentication Flow (M2M/H2H)

### 1️⃣ Request OAuth2 Token

curl -X POST http://localhost:8000/api/oauth/token
-H "Content-Type: application/json"
-d '{
"grant_type": "client_credentials",
"client_id": "YOUR_CLIENT_ID",
"client_secret": "YOUR_CLIENT_SECRET"
}'


**Response:**
{
"token_type": "Bearer",
"expires_in": 31536000,
"access_token": "eyJ0eXAiOiJKV1QiLCJhbGc..."
}


### 2️⃣ Gunakan Token untuk Request API

curl -X GET "http://localhost:8000/api/weather?city=Jakarta"
-H "Authorization: Bearer YOUR_ACCESS_TOKEN"


**Response:**
{
"status": "success",
"data": {
"city": "Jakarta",
"temperature": "28°C",
"condition": "Partly Cloudy"
}
}

---

## 💻 Installation & Setup

### Prerequisites

- PHP 8.2 atau lebih tinggi
- Composer
- MySQL/MariaDB
- Git

### Step 1: Clone Repository

git clone https://github.com/rifkstwan/UAS_API.git
cd UAS_API


### Step 2: Install Dependencies

composer install


### Step 3: Environment Configuration

cp .env.example .env
php artisan key:generate


Edit `.env` dan sesuaikan database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uas_api
DB_USERNAME=root
DB_PASSWORD=your_password


### Step 4: Database Migration

php artisan migrate


### Step 5: Install Passport

php artisan passport:install


### Step 6: Create OAuth2 Client

php artisan passport:client --client


**Simpan Client ID dan Client Secret yang muncul!**

### Step 7: Generate Swagger Documentation

php artisan l5-swagger:generate


### Step 8: Run Development Server

php artisan serve


Aplikasi berjalan di `http://localhost:8000`

---

## 🧪 Testing API

### Test dengan cURL

1. Get Token
TOKEN=$(curl -s -X POST http://localhost:8000/api/oauth/token
-H "Content-Type: application/json"
-d '{"grant_type":"client_credentials","client_id":"YOUR_ID","client_secret":"YOUR_SECRET"}'
| jq -r '.access_token')

2. Test Weather Endpoint
curl -X GET "http://localhost:8000/api/weather?city=Jakarta"
-H "Authorization: Bearer $TOKEN"

3. Test Stock Price
curl -X GET "http://localhost:8000/api/stock/price?symbol=AAPL"
-H "Authorization: Bearer $TOKEN"


### Test dengan Swagger UI

1. Buka `http://localhost:8000/api/documentation`
2. Klik tombol **"Authorize"**
3. Masukkan: `Bearer YOUR_ACCESS_TOKEN`
4. Klik **"Authorize"** → **"Close"**
5. Pilih endpoint dan klik **"Try it out"**
6. Isi parameter dan klik **"Execute"**

---

## 📁 Project Structure


```

UAS_API/
├── app/
│ ├── Http/
│ │ ├── Controllers/
│ │ │ └── Api/
│ │ │ └── GoApiController.php # Main API Controller
│ │ └── Middleware/
│ │ └── ApiTokenMiddleware.php # Token Validation
│ └── Providers/
│ ├── AppServiceProvider.php
│ └── AuthServiceProvider.php # Passport Configuration
├── config/
│ └── l5-swagger.php # Swagger Configuration
├── database/
│ └── migrations/ # Passport OAuth Tables
├── resources/
│ └── views/
│ └── swagger.blade.php # Swagger UI Template
├── routes/
│ ├── api.php # API Routes
│ └── web.php # Web Routes (Swagger)
└── storage/
└── api-docs/
└── api-docs.json # Generated Swagger JSON

```

---

## 🛠️ Technologies Used

- **Backend:** Laravel 11
- **Authentication:** Laravel Passport (OAuth2)
- **Documentation:** L5-Swagger (OpenAPI 3.0)
- **Database:** MySQL
- **PHP Version:** 8.4
- **Token Type:** JWT (JSON Web Token)

---

## 👨‍💻 Author

**Rifki Setiawan**  
📧 Email: rifkikurniawan2233@gmail.com  
🎓 Pengembangan Aplikasi Bisnis - UAS 2025

---

## 📚 References

- [Laravel Documentation](https://laravel.com/docs/11.x)
- [Laravel Passport](https://laravel.com/docs/11.x/passport)
- [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
- [OAuth2 Client Credentials Grant](https://oauth.net/2/grant-types/client-credentials/)

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🙏 Acknowledgments

Terima kasih kepada:
- Dosen Pengembangan Aplikasi Bisnis
- Laravel Community
- OpenAPI/Swagger Community

---

**⭐ Star this repository if you find it helpful!**
