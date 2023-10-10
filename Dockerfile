FROM php:8.2-cli

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


RUN apt-get update
RUN apt-get install -y git
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip

WORKDIR /var/assessments