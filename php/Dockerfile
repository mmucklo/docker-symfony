FROM php:7.3-fpm
RUN apt update && apt install -y \
    libfreetype6 \
    libzip-dev \
    libicu63 \
    tidy \
    libjpeg62-turbo \
    libpng16-16 \
    libxml2 \
    libcurl4-openssl-dev \
    libldap2-dev \
    libbz2-1.0 \
    sqlite3 \
    git \
    locales \
    && apt install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libicu-dev \
        libpng-dev \
        libpq-dev \
        libxml2-dev \
        libldap2-dev \
        libbz2-dev \
        libtidy-dev \
	libsqlite3-dev \
    && docker-php-ext-install -j$(nproc) dom iconv gettext mysqli bz2 fileinfo hash pcntl shmop intl json bcmath mbstring posix tokenizer opcache simplexml xmlrpc xmlrpc xml curl zip soap pdo pdo_mysql pdo_pgsql pdo_sqlite pgsql session sockets sysvmsg sysvsem sysvshm tidy wddx \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd ldap \
    && apt remove -y \
        libjpeg62-turbo-dev \
        libicu-dev \
        libpng-dev \
        libxml2-dev \
        libldap2-dev \
        libbz2-dev \ 
    && apt purge -y \
        libjpeg62-turbo-dev \
        libpng12-dev \
        libxml2-dev \
        libldap2-dev \
        libbz2-dev \
    && apt clean
    RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    pecl install igbinary && \
    docker-php-ext-enable igbinary && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    apt install -y libmemcached11 libhashkit2 libmemcachedutil2 && \
    apt install -y libmemcached-dev && \
    pecl install memcached && \
    docker-php-ext-enable memcached && \
    apt remove -y libmemcached-dev && \
    apt install -y libssl-dev && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb && \
    apt remove -y libssl-dev && \
    apt autoremove -y && \
    apt clean
RUN sed -i 's/# de_DE/de_DE/g' /etc/locale.gen
RUN sed -i 's/# en_US/en_US/g' /etc/locale.gen
RUN locale-gen 
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
RUN curl --url https://getcomposer.org/composer.phar -o /usr/local/bin/composer.phar && chmod a+x /usr/local/bin/composer.phar
RUN apt install wget
RUN wget https://get.symfony.com/cli/installer -O - | bash
ARG XDEBUG_REMOTE_HOST=localhost
RUN echo xdebug.remote_host=${XDEBUG_REMOTE_HOST} >> /usr/local/etc/php/conf.d/xdebug.ini
RUN composer.phar self-update
