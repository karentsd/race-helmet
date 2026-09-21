FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev unzip git curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm ci && npm run build && rm -rf node_modules
RUN chown -R www-data:www-data storage bootstrap/cache

COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"]