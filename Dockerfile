FROM wordpress:latest

RUN curl -sO https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

RUN pecl install redis \
    && docker-php-ext-enable redis

COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY --chown=www-data:www-data mu-plugins/ /usr/src/wordpress/wp-content/mu-plugins/
COPY --chown=www-data:www-data mu-plugins/ /var/www/html/wp-content/mu-plugins/
