# Benew® Clinic — Bilingual (EN/AR) Meta Ads Landing Page, REST API & Admin Dashboard (Laravel + MySQL)

## Quick Setup
1. Extract the archive and enter the project folder:
   ```bash
   cd benew-laravel-final
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
2. Configure your MySQL database & clinic contact details inside `.env`.
3. Run migrations, seed the 14 bilingual dental services + default admin user, and link storage:
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```
4. Start the server (accessible from your **mobile phone** on the same Wi-Fi):
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```
   Open `http://<YOUR_PC_LOCAL_IP>:8000` on your mobile browser.

## Admin Access (Direct URL Only)
- **URL:** `/admin/login`
- **Email:** `admin@benew.com`
- **Password:** `Benew@2026!` (change immediately in Dashboard -> Change Password)
