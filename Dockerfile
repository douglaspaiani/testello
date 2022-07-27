# php-apache
FROM php:8.1.0-apache
# informa o diretório raiz do Docker
WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql && apachectl restart

# Instala Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer

# ativa o mod_rewrite do Apache
RUN a2enmod rewrite

ADD ./.docker/custom-php.ini /usr/local/etc/php/conf.d/custom-php.ini

