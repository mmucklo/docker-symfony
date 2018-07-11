FROM php:7.2-fpm
RUN apt-get update && apt-get install -y \
    libfreetype6 \
    libjpeg62-turbo \
    libicu57 \
    libpng16-16 \
    libxml2 \
    libcurl4-openssl-dev \
    libldap2-dev \
    libbz2-1.0 \
    libtidy5 \
    git \
    && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libicu-dev \
        libpng-dev \
        libxml2-dev \
        libldap2-dev \
        libbz2-dev \
        libtidy-dev \
    && docker-php-ext-install -j$(nproc) dom iconv gettext mysqli bz2 fileinfo hash pcntl shmop intl json bcmath mbstring posix tokenizer opcache simplexml xmlrpc xmlrpc xml curl zip soap pdo pdo_mysql pdo_pgsql pdo_sqlite pgsql session sockets sysvmsg sysvsem sysvshm tidy wddx \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd ldap \
    && apt-get remove -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libicu-dev \
        libpng-dev \
        libxml2-dev \
        libldap2-dev \
        libbz2-dev \ 
        libtidy-dev \
    && apt-get purge -y \ 
        libfreetype6-dev \
        libjpeg62-turbo-dev \
	    libicu-dev \
        libpng12-dev \
        libxml2-dev \
        libldap2-dev \
        libbz2-dev \
        libtidy-dev \
    && apt-get clean
    RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    pecl install igbinary && \
    docker-php-ext-enable igbinary && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    apt-get install -y libmemcached11 libhashkit2 libmemcachedutil2 && \
    apt-get install -y libmemcached-dev && \
    pecl install memcached && \
    docker-php-ext-enable memcached && \
    apt-get remove -y libmemcached-dev && \
    apt-get install -y libssl-dev && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb && \
    apt-get remove -y libssl-dev && \
    apt-get autoremove -y && \
    apt-get clean
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
RUN curl --url https://getcomposer.org/composer.phar -o /usr/local/bin/composer.phar && chmod a+x /usr/local/bin/composer.phar
ARG XDEBUG_REMOTE_HOST=localhost
RUN echo xdebug.remote_host=${XDEBUG_REMOTE_HOST} >> /usr/local/etc/php/conf.d/xdebug.ini
RUN composer.phar self-update
