# e-Dok Kepegawaian

| Laravel Version | Branch |
| :-------------: | :----: |
|       10        |  main  |

## Requirements

-   PHP 8.2
-   Composer
-   laravel 10
-   Laravel Datatable Yajra
-   Laravel Excel
-   php8.2-zip
-   php8.2-gd

## Installation

-   Clone the repo and `cd` into it
-   Run `composer install`
-   Rename or copy `.env.example` file to `.env`
-   Run `php artisan key:generate`
-   Set your database credentials in your `.env` file
-   Run migration `php artisan migrate`
-   Run seeders `php artisan db:seed`
-   Run seeders `php artisan db:seed --class=RoleKeuanganSeeder`
-   Install `composer require yajra/laravel-datatables:^10.0`
-   Run `php artisan vendor:publish --tag=datatables`
-   Install `sudo apt-get install php8.2-zip php8.2-gd`
-   Install `composer require maatwebsite/excel:^3.1`
-   Run `composer update`
-   Run `php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config`


## Note

First, check your PHP version.

```
php -v
```

The command below will print the path to the php.ini file that your server is using.

```
php -i | grep php.ini
```

Next.

```
sudo nano /etc/php/8.2/cli/php.ini
```

The values of post_max_size, upload_max_filesize and memory_limit by default have the value of 8M, 2M, and 128M respectively.
Search for those variables and change their values, whilst ensuring that the sizes follow the same ratio as the default values.
See example below:

```
post_max_size = 2048M
upload_max_filesize = 2048M
memory_limit = 2048M
```

Restart your web server.

```
sudo service apache2 restart
```
