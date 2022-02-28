FROM php:8.1-fpm

RUN apt-get update && apt-get install -y libpq-dev \
        curl \
        && docker-php-ext-install -j$(nproc) pgsql \
        && docker-php-ext-install -j$(nproc) pdo_pgsql

COPY . /var/www/html

WORKDIR /var/www/html

CMD ["php-fpm"]