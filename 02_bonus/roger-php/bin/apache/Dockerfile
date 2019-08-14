FROM php:7.2-apache
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Other PHP7 Extensions
RUN docker-php-ext-install pdo_mysql 
RUN a2enmod rewrite headers