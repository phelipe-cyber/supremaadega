
FROM php:7.4-apache

WORKDIR /app

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip
RUN docker-php-ext-enable intl mbstring zip

RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/


RUN sed -e '/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' -i /etc/apache2/apache2.conf

COPY ../ /app/

EXPOSE 80
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]