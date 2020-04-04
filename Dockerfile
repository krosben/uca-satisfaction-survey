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

ENV PORT 8080
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

COPY . /var/www/html
COPY --from=vendor /app/vendor/ /var/www/html/vendor/

RUN sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf \
  #
  # Change APACHE_DOCUMENT_ROOT
  && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
  && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
  #
  # Enable .htaccess
  && a2enmod rewrite