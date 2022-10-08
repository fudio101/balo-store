## BaloStore
Website selling backpacks coded in Laravel


## Requirement
- Php 8.1.5
- Composer
- MySQL
- Xampp

## Deploy project

Run the command
```
composer install
cp .env.example .env
php artisan key:generate
```

Edit .env file
```
# database config
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=<port>
DB_DATABASE=<database name>
DB_USERNAME=<username>
DB_PASSWORD=<password>

# email config
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=<your email>
MAIL_PASSWORD=<your email app password>
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# aws config
AWS_ACCESS_KEY_ID=AKIASHHQAH6RBEFTILWF
AWS_SECRET_ACCESS_KEY=pJehOh+pHDxl1F7vsoOeQLYKDxO5sj4EZimxuaet
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=balo-store
AWS_USE_PATH_STYLE_ENDPOINT=false
AWS_URL=
FILESYSTEM_DRIVER=s3
```

Run the command
```
php artisan db:seed
```

Run web by Xampp
- http://localhost/balo-store/public/ is user interface
- http://localhost/balo-store/public/admin is admin interface
    - Username: admin
    - Password: Admin123
