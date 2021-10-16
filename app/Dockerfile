FROM php:7.4

RUN apt-get update -y && apt-get install -y openssl zip unzip git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app

RUN chmod -R 755 /app
RUN chown -R www-data:www-data /app

COPY . .

RUN composer install
RUN composer require --dev  predis/predis

CMD php artisan serve --host=0.0.0.0
EXPOSE 8000
