FROM php:8.1-fpm-bullseye

#ARG user
#ARG uid

USER root

RUN apt-get update

RUN apt-get install -y curl \
    libcurl4-openssl-dev \
    pkg-config \
    libonig-dev \
    libxml2-dev \
    git

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

RUN docker-php-ext-install ctype
RUN docker-php-ext-install curl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install xml
RUN docker-php-ext-install dom

RUN apt-get install -y \
            libzip-dev \
            zip \
      && docker-php-ext-install zip

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --version=2.2.4 --install-dir=/usr/bin --filename=composer

#RUN useradd -G www-data,root -u $uid -d /home/$user $user
#RUN mkdir -p /home/$user/.composer && \
#    chown -R $user:$user /home/$user

WORKDIR /var/www/app
COPY . /var/www/app

#USER $user

RUN composer install --prefer-dist

EXPOSE 9000