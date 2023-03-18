FROM php:8.0-apache

RUN apt-get update && apt-get upgrade -y
# install gd-library 
RUN apt-get install -y \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev libzip-dev \
&& a2enmod rewrite \
&& a2enmod headers
# \ --> breakline 

# configure gd library
RUN docker-php-ext-configure gd --with-freetype --with-jpeg 
RUN docker-php-ext-install opcache gd pdo_mysql zip 

# enable extantions
RUN docker-php-ext-enable opcache gd zip 
# add new line to the .conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
# retsart apache service after adding line
RUN service apache2 restart
