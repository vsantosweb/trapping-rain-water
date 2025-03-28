FROM php:8.3

COPY . /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN cd /var/www/html
# Install composer

RUN composer install

CMD ["php", "-S", "0.0.0.0:8000"]
