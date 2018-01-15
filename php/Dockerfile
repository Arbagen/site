FROM php:7.2-rc-fpm
RUN apt-get update && apt-get install -y git mc
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pdo_mysql
RUN usermod -u 1000 www-data
COPY ./config/php.ini /usr/local/etc/php/php.ini
# Install Composer and make it available in the PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
#xdebug
ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug-2.6.0beta1 && docker-php-ext-enable xdebug && \
    echo "\n xdebug.remote_host=dockerhost \n xdebug.remote_enable = 1 \n xdebug.remote_port = 9000 \n xdebug.max_nesting_level = 500 \n xdebug.remote_autostart=1 \n xdebug.remote_connect_back=1" >> /usr/local/etc/php/php.ini \
;fi

