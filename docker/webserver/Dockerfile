FROM ubuntu

MAINTAINER Jaco Koekemoer <jaco.wk@gmail.com>

LABEL Description="Ubuntu Apache2 PHP7 installation" Vendor="jericho" Version="1.0"

# Update APT=GET
RUN apt-get update

# Install Apache
RUN apt-get -y install apache2

# Change /bin/sh permissions
CMD chmod 777 /bin/sh

# Install PHP
RUN apt-get -y install software-properties-common && \
 apt-get -y  install python-software-properties && \
 add-apt-repository ppa:ondrej/php && \
 apt-get install -y language-pack-en-base && \
 LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php && \
 apt-get update && \
 apt-get -y install php7.0 && \
 apt-get -y install php7.0-mysql && \
 apt-get -y install php-xml && \
 apt-get -y install php-mbstring && \
 apt-get -y install php7.0-gd && \
 apt-get -y install phpunit

# Install GIT
RUN apt-get update && \
 apt-get -y install git

# Install nano
RUN apt-get -y install nano

# Install zip unzip
RUN apt-get update && \
 apt-get -y install zip unzip

# Install composer
RUN apt-get update && \
 apt-get -y install curl && \
 curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Get Jericho source
RUN cd /var/www/html && \
 git clone https://github.com/jacowk/jericho-laravel.git jericho && \
 cd /var/www/html/jericho && \
 composer update && \
 php artisan key:generate

# Startup Apache
CMD service apache2 start

# Expose port
EXPOSE 8000


