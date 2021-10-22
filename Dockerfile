FROM php:7.4-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependies
RUN apt-get update && apt-get upgrade -y && apt-get install -y apt-utils

RUN apt-get install -y libmcrypt-dev \
    libxml2-dev \
    libldb-dev \
    libldap2-dev \
    libxml2-dev \
    libssl-dev \
    libxslt-dev \
    libpq-dev \
    postgresql-client \
    libsqlite3-dev \
    libsqlite3-0 \
    libc-client-dev \
    libkrb5-dev \
    curl \
    libcurl3-dev \
    firebird-dev \
    libpspell-dev \
    aspell-en \
    aspell-de \
    libtidy-dev \
    libsnmp-dev \
    librecode0 \
    librecode-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    libzip-dev

RUN apt-get install -y libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

#RUN pecl install apc
RUN docker-php-ext-install opcache
RUN yes | pecl install mcrypt-1.0.3 \
    xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

#Install docker-ext
RUN docker-php-ext-install soap ftp xsl bcmath calendar ctype dba dom zip session

RUN docker-php-ext-install sockets pgsql pdo_pgsql pdo_mysql
RUN docker-php-ext-install mysqli gd curl exif gettext pdo_firebird opcache

RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl

RUN docker-php-ext-install imap pcntl phar posix pspell shmop simplexml snmp sysvmsg sysvsem sysvshm
RUN docker-php-ext-install tidy xml xmlrpc

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/

# Copy existing application directory permissions
RUN chown -R www-data:www-data /var/www
RUN chown -R 755 /var/www/storage

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
