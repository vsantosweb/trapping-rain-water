FROM php:8.3

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*
    
COPY . /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN cd /var/www/html

# Install composer
RUN composer install

COPY .env.example .env
RUN php artisan key:generate

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
