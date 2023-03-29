# Laravel Boilerplate
# Installations

## Basic Installations
### Install PHP

```bash
$ sudo apt install software-properties-common
$ sudo add-apt-repository ppa:ondrej/php
$ sudo apt update
```

```bash
$ sudo apt install php8.0
```

confirm your PHP version:

```bash
$ php -v
```

```bash
# Output
PHP 8.0.11 (cli) (built: Sep 23 2021 21:26:24) ( NTS )
Copyright (c) The PHP Group
Zend Engine v4.0.11, Copyright (c) Zend Technologies
    with Zend OPcache v8.0.11, Copyright (c), by Zend Technologies
    with Xdebug v3.0.4, Copyright (c) 2002-2021, by Derick Rethans
```

For the php extensions;

```bash
$ sudo apt install php8.0-extension_name
```
```bash
# Example:
$ sudo apt install php8.0-fpm \
    php8.0-mysql \
    php8.0-xml \
    php8.0-curl \
    php8.0-mbstring \
    php8.0-dom \
    php8.0-redis \
    php8.0-pgsql
```

[comment]: <> (```bash)

[comment]: <> ($ sudo apt install php8.0-common php8.0-mysql php8.0-xml php8.0-curl php8.0-gd php8.0-imagick php8.0-cli php8.0-dev php8.0-imap php8.0-mbstring php8.0-opcache php8.0-soap php8.0-zip php8.0-pgsql -y)

[comment]: <> (```)

### Install Composer

```bash
$ sudo apt update
$ sudo apt install php-cli unzip
```

```bash
$ cd ~
$ curl -sS https://getcomposer.org/installer -o composer-setup.php
```
```bash
$ HASH=`curl -sS https://composer.github.io/installer.sig`
$ echo $HASH
```

```bash
# Output
e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a
```

```bash
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```

```bash
# Output
Installer verified
```
```bash
$ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

```bash
# Output
All settings correct for using Composer
Downloading...

Composer (version 1.10.5) successfully installed to: /usr/local/bin/composer
Use it: php /usr/local/bin/composer
```
To test your installation, run:
```bash
$ composer
```

```bash
Output
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 1.10.5 2020-04-10 11:44:22

Usage:
  command [options] [arguments]
```

## Project Install

```bash
# clone the repo
$ git clone https://{BITBUCKET_USERNAME}@bitbucket.org/getirdev/gis-panel-backend.git
```

```bash
# install app's dependencies
$ composer install
```

### Next step
```bash
#create .env file
cp .env.example .env

# generate laravel APP_KEY
$ php artisan key:generate
```

Setup database in `.env` file. For this, first you have to create a database.

```bash
#in .env file
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1 #your db address
DB_PORT=5432 #your db port
DB_DATABASE=laravel #project db
DB_USERNAME=postgres #your db username
DB_PASSWORD=postgres #your db password
```
Migration
```bash
# run database migration
$ php artisan migrate
```

Install passport
```bash
$ php artisan passport:install
```

###Serving
```bash
php artisan serve
```
```bash
Output
Starting Laravel development server: http://127.0.0.1:8000
[Sun Feb 28 20:19:32 2021] PHP 8.0.2 Development Server (http://127.0.0.1:8000) started
```

In your API Platform (like Postman) you can send requests via `127.0.0.1:8000\api\auth\{endpoint}`.

The endpoint list availeble in:

```bash
php artisan route:list
```

For Login, send a request to `127.0.0.1:8000\api\auth\login` with these parameters;

```bash
user: admin@admin.com
password: admin
```
