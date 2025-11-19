# Instalasi

## Clone Repository:
```
# Clone repository
git clone https://github.com/mhbb8897/reservasi-mutiara-futsal.git

# Masuk ke direktori
cd reservasi-mutiara-futsal

# Install Composer & Nodejs package
composer install
npm install

# Salin file .env
cp .env.example .env

# Generate key
php artisan key:generate

# Migrasi database:
php artisan migrate

# Seed data:
php artisan db:seed

# Build file file css dan javascript agar tidak usah menjalankan environment nodejs
npm run build

Jalankan server Laravel:
php artisan serve

```
