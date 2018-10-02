# LMS - Laravel
### v2.1

Prepare your .env file there with database connection and other settings.

## Getting Started

```
composer install
composer dump-autoload
php artisan migrate --seed
php artisan key:generate
php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
php artisan serve
```

## Login

Email: admin@admin.com
Password: password