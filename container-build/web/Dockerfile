FROM ubuntu:latest

MAINTAINER Fernando M. Martins <fernando@tecnando.com.br>
ENV DEBIAN_FRONTEND noninteractive
ENV DEBCONF_NONINTERACTIVE_SEEN true
ENV APACHE_DOCUMENT_ROOT /var/www/public

# Install apache, PHP 8.1
RUN apt-get update \
&& apt-get install jq mcrypt php-gd php-curl curl php-bcmath php-mysql php-intl php-zip php-imagick php-pgsql php-sqlite3 php-xml php-memcache php-cli unzip php-mbstring libapache2-mod-php php-soap -y \
&& sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
&& sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
&& sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf \
&& a2enmod php8.1 \
&& a2enmod rewrite \
&& curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer

# Expose apache.
EXPOSE 80
WORKDIR /var/www
CMD /usr/sbin/apache2ctl -D FOREGROUND
