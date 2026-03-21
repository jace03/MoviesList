View cache fix and storage directories

I created a default `config/view.php` and ensured storage directories exist so Blade can write compiled views.

If you still see errors, run the following commands from your project root (Windows cmd.exe):

```
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

If you had previously run `php artisan config:cache`, delete `bootstrap/cache/config.php` or run `php artisan config:clear` to refresh cached config.

Also ensure your `.env` exists (copy `.env.example` or create one) and that `APP_DEBUG=true` while developing.

If you want me to create a basic `.env` file for local dev, tell me and I'll add one (I'll assume database credentials, APP_URL=http://127.0.0.1:8000, APP_DEBUG=true).
