# LMS - Laravel

Prepare your .env file there with database connection and other settings.

## Getting Started

```
composer install
php artisan migrate --seed
php artisan key:generate
php artisan serve
php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
```

### Login

Email: admin@admin.com
Password: password