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
RUN curl --url https://getcomposer.org/composer.phar -o /usr/local/bin/composer && chmod a+x /usr/local/bin/composer
RUN apt install wget
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN ln -s /root/.symfony/bin/symfony /usr/local/bin/.
ARG XDEBUG_REMOTE_HOST=localhost
RUN echo xdebug.remote_host=${XDEBUG_REMOTE_HOST} >> /usr/local/etc/php/conf.d/xdebug.ini
RUN composer self-update
RUN cd /var/www && symfony new --full --no-git symfony
RUN cd /var/www/symfony && composer require symfony/orm-pack && composer require --dev symfony/maker-bundle
RUN cd /var/www/symfony && sed -i 's/DATABASE_URL/# DATABASE_URL/g' .env
RUN cd /var/www/symfony && echo 'DATABASE_URL="mysqli://doctrine:doctrine@mysql:3306/doctrine"' >> .env
COPY setlocale.php /var/www/symfony
RUN mkdir -p /var/www/symfony/src/Entity
COPY GrumpyPuppy.php /var/www/symfony/src/Entity/GrumpyPuppy.php
RUN mkdir -p /var/www/symfony/src/Command
COPY GrumpyPuppyCommand.php /var/www/symfony/src/Command/GrumpyPuppyCommand.php
RUN mkdir -p /var/www/symfony/src/Repository
COPY GrumpyPuppyRepository.php /var/www/symfony/src/Repository/GrumpyPuppyRepository.php
RUN mkdir -p /var/www/symfony/src/Migrations
COPY Version20190719053443.php /var/www/symfony/src/Migrations/Version20190719053443.php
RUN mv /var/www/symfony /var/www/symfony.new
