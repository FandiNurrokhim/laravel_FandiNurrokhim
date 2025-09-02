# Medify Test - Setup & Installation

## 1. Clone Repository
```bash
git clone <repo-url>
cd medify-test
```

## 2. Install PHP Dependencies
```bash
composer install
```

## 3. Copy & Edit Environment File
```bash
cp .env.example .env
```
- Edit `.env` sesuai konfigurasi database Anda.

## 4. Generate Application Key
```bash
php artisan key:generate
```

## 5. Install Node Modules
```bash
npm install
```

## 6. Build Frontend Assets
```bash
npm run dev
```

## 7. Migrate Database
```bash
php artisan migrate
```

## 8. (Optional) Seed Database
```bash
php artisan db:seed
```

## 9. Start Development Server
```bash
php artisan serve
```

## 10. Login & Usage
- Register user melalui halaman `/register`.
- Login melalui halaman `/login`.
- Semua fitur Rumah Sakit dan Pasien hanya bisa diakses setelah login.

---

**Tech Stack:**  
- Laravel  
- Bootstrap 5  
- DataTables  
- JQuery

**Catatan:**  
- Pastikan sudah install PHP, Composer, Node.js, dan npm di komputer Anda.
- Untuk reset database: `php artisan migrate:fresh --seed`