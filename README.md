# e-Dok Kepegawaian

| Laravel Version | Branch |
| :-------------: | :----: |
|       10        |  main  |

## Requirements

-   PHP >= 8.1.0
-   Composer

## Installation

-   Clone the repo and `cd` into it
-   Run `composer install`
-   Rename or copy `.env.example` file to `.env`
-   Run `php artisan key:generate`
-   Set your database credentials in your `.env` file
-   Run migration `php artisan migrate`

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
sudo nano /etc/php/7.4/cli/php.ini
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
