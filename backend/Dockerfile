FROM php:8.4-cli

RUN apt-get update -y && apt-get install -y \
  git \
  unzip \
  curl \
  libzip-dev \
  libpq-dev \
  default-mysql-client \
  && docker-php-ext-install pdo_mysql \
  && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 8000

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=8000"]