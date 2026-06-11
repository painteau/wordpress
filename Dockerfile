FROM wordpress:latest

RUN apt-get update \
    && apt-get install -y --no-install-recommends gosu \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/* /tmp/pear

RUN curl -sO https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp.phar \
    && printf '#!/bin/sh\nif [ "$(id -u)" = "0" ]; then\n  exec gosu www-data /usr/local/bin/wp.phar "$@"\nelse\n  exec /usr/local/bin/wp.phar "$@"\nfi\n' > /usr/local/bin/wp \
    && chmod +x /usr/local/bin/wp

COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY --chown=www-data:www-data mu-plugins/ /usr/src/wordpress/wp-content/mu-plugins/
COPY --chown=www-data:www-data mu-plugins/ /var/www/html/wp-content/mu-plugins/
