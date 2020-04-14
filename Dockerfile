FROM composer:1.9 as vendor

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
  --ignore-platform-reqs \
  --no-interaction \
  --prefer-dist \
  --no-scripts \
  --no-plugins \
  --no-dev

FROM php:7.4-apache as release

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

COPY . /var/www/html
COPY --from=vendor /app/vendor/ /var/www/html/vendor/

RUN docker-php-ext-install pdo_mysql \
  #
  # Change APACHE_DOCUMENT_ROOT
  && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
  && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
  #
  # Enable .htaccess
  && a2enmod rewrite