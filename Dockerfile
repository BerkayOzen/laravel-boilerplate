FROM nginx:1.21.3

RUN apt update
RUN apt install -y \
    gnupg2 \
    ca-certificates \
    apt-transport-https \
    software-properties-common \
    zip \
    unzip \
    wget

# Add php 8 repository
RUN wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -
RUN echo "deb https://packages.sury.org/php/ buster main" | tee /etc/apt/sources.list.d/php.list

# Add php 8 repository
RUN apt update

RUN apt dist-upgrade -y

RUN apt install -y php8.0

RUN apt install -y \
    php8.2-fpm \
    php8.2-mysql \
    php8.2-xml \
    php8.2-curl \
    php8.2-mbstring \
    php8.2-dom \
    php8.2-redis \
    php8.2-pgsql

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  php composer-setup.php && \
  php -r "unlink('composer-setup.php');" && \
  mv composer.phar /usr/local/bin/composer

COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY deploy/php.ini /etc/php/8.2/fpm/conf.d/custom.ini
RUN sed -i 's/user  nginx;/user  root;/g' /etc/nginx/nginx.conf
RUN sed -i 's/user = www-data/user = root/g' /etc/php/8.0/fpm/pool.d/www.conf
RUN sed -i 's/group = www-data/group = root/g' /etc/php/8.0/fpm/pool.d/www.conf
RUN sed -i 's/listen.owner = www-data/listen.owner = root/g' /etc/php/8.0/fpm/pool.d/www.conf
RUN sed -i 's/listen.group = www-data/listen.group = root/g' /etc/php/8.0/fpm/pool.d/www.conf
RUN mkdir -p /run/php

COPY . /app

COPY .env /app/.env

WORKDIR /app

RUN composer install
RUN php artisan optimize

EXPOSE 80

COPY entry.sh /entry.sh
RUN chmod +x /entry.sh

CMD ["/entry.sh"]
