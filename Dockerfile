FROM php:8.4-cli-bookworm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo_mysql \
        mbstring \
        xml \
        zip \
        bcmath

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Application directory
WORKDIR /app

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Install Node.js and npm
COPY --from=node:22-bookworm /usr/local/bin/node /usr/local/bin/node
COPY --from=node:22-bookworm /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Install frontend dependencies and build Vite
RUN npm install
RUN npm run build

# Create Laravel storage link
RUN php artisan storage:link || true

# Railway provides the PORT environment variable
EXPOSE 8080

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}