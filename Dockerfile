FROM php:8.1-fpm-bullseye

USER root

#ENV TZ=UTC
#RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update

RUN apt-get install -y curl \
    libcurl4-openssl-dev \
    pkg-config \
    libonig-dev \
    libxml2-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

RUN docker-php-ext-install ctype
RUN docker-php-ext-install curl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install xml
RUN docker-php-ext-install dom

RUN pecl install xdebug
RUN  docker-php-ext-enable xdebug

WORKDIR /var/www/app
COPY . /var/www/app

#RUN chown -R www-data.www-data /var/www/storage
#RUN chown -R www-data.www-data /var/www/bootstrap/cache

EXPOSE 9000
