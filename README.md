# Central Hospital Indore

Hospital website and administration panel built with Laravel 13, PHP 8.3+, Blade and Vite. Public content is written for the hospital's operational launch, including 24-hour availability.

## Local development

1. Run `composer install` and `npm ci`.
2. Copy `.env.example` to `.env`, configure the database and set `APP_URL`.
3. Run `php artisan key:generate` for a new installation.
4. Set `ADMIN_EMAIL` and a unique `ADMIN_PASSWORD` of at least 12 characters before seeding.
5. Run `php artisan migrate --seed` and `php artisan storage:link`.
6. Run `npm run build` and `php artisan serve`. Run `npm run dev` separately for asset development.

The administration panel is at `/admin/login`. Appointments and enquiries are saved in the database and show confirmation; visitors may then choose to continue on WhatsApp. WhatsApp messages and email notifications are not sent automatically.

## Checks

Run `php artisan test` (isolated in-memory SQLite database), `npm run build`, and `php artisan view:cache`.

## Production deployment

- Point the web server document root to `public/` and enable HTTPS.
- Set `APP_ENV=production`, `APP_DEBUG=false`, the final HTTPS `APP_URL`, and `SESSION_SECURE_COOKIE=true`.
- Configure persistent database, storage and cache; back up the database and uploaded files.
- Run `composer install --no-dev --optimize-autoloader`, `npm ci`, `npm run build`, `php artisan migrate --force`, `php artisan storage:link`, and `php artisan optimize`.
- Seed only a new installation after configuring admin credentials. Existing administrator passwords are preserved by seeding.
- Verify phone, WhatsApp, email, address and map links in site settings.
- Verify `/sitemap.xml`, `/robots.txt`, forms and uploaded images on the final domain. The sitemap includes active doctors and published articles.

The resource page displays only files present under `public/`. AI-enhanced hospital images are documented in `public/images/hospital/README.md` and retain illustrative captions.
