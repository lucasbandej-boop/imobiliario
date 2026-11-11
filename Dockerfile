FROM php:8.2-fpm

# Instala dependências essenciais do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev

# Instala apenas as extensões estritamente necessárias para Laravel e PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring zip

# Copia o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Instala dependências ignorando requerimentos rígidos de plataforma
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

EXPOSE 9000
CMD ["php-fpm"]
