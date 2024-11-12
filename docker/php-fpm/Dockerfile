FROM phpdockerio/php:7.4-fpm
WORKDIR "/var/www/myapp"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    php7.4-intl \
    php7.4-mysql \
    php7.4-sqlite3 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
