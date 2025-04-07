# Etapa 1: imagem base PHP com Apache
FROM php:8.1-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install zip pdo pdo_pgsql mbstring

# Ativa o mod_rewrite
RUN a2enmod rewrite

# Copia arquivos da aplicação
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala dependências PHP
RUN composer install --optimize-autoloader --no-dev

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Ajustar permissões para o diretório public/assets/
RUN chmod -R 755 /var/www/html/public/assets/

# Copia o virtual host customizado
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Porta da aplicação
EXPOSE 80

# Comando para iniciar o Apache + Laravel
CMD php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan migrate --force && \
php artisan db:seed --force && \
apache2-foreground