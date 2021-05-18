FROM php:7.4-apache

RUN apt-get update
RUN apt-get install -y

RUN apt-get install -y curl
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev
RUN apt-get install -y libicu-dev
RUN docker-php-ext-install intl
RUN docker-php-ext-configure intl
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
RUN docker-php-ext-install gd

# Replace these certificates with org-certs
RUN apt-get install -y ssl-cert
# Setup Apache2 mod_ssl
RUN a2enmod ssl
# Setup Apache2 HTTPS env
RUN a2ensite default-ssl.conf
# Work directory
WORKDIR /var/www/html


CMD ["apache2-foreground"]