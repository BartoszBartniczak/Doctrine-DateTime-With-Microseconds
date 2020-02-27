FROM php:7.3-cli

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y git wget zip libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install pdo_mysql

RUN wget https://getcomposer.org/composer.phar && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer

WORKDIR /app
