FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
  libpq-dev \ 
  build-essential \
  libpng-dev \
  libjpeg62-turbo-dev \
  libfreetype6-dev \
  locales \
  zip \
  jpegoptim optipng pngquant gifsicle \
  vim \
  unzip \
  git \
  curl \
  libonig-dev \
  libzip-dev

WORKDIR  /var/www/html

COPY attendance /var/www/html

RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer install

RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R a+rw /var/www/html/storage
RUN chmod -R a+rw /var/www/html/bootstrap