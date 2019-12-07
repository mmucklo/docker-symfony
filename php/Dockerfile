FROM php:7.4-fpm
RUN apt update && apt install -y \
    gnupg \
    libfreetype6 \
    libzip-dev \
    libicu63 \
    tidy \
    libjpeg62-turbo \
    libpng16-16 \
    libxml2 \
    libffi-dev \
    libcurl4-openssl-dev \
    libldap2-dev \
    libbz2-1.0 \
    sqlite3 \
    git \
    unzip \
    locales \
    libaio1 \
    libxslt1.1 \
    libsnmp30 \
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
	libgmp-dev \
        libpspell-dev \
        libsnmp-dev \
        libxslt1-dev \
    && curl -L --url https://download.oracle.com/otn_software/linux/instantclient/195000/instantclient-sdk-linux.x64-19.5.0.0.0dbru.zip -o ~/instantclient-sdk-linux.x64-19.5.0.0.0dbru.zip \
    && curl -L --url https://download.oracle.com/otn_software/linux/instantclient/195000/instantclient-basic-linux.x64-19.5.0.0.0dbru.zip -o ~/instantclient-basic-linux.x64-19.5.0.0.0dbru.zip \
    && curl -L --url https://public.dhe.ibm.com/ibmdl/export/pub/software/data/db2/drivers/odbc_cli/linuxx64_odbc_cli.tar.gz -o ~/linuxx64_odbc_cli.tar.gz \
    && cd /usr/local && tar xzf ~/linuxx64_odbc_cli.tar.gz && cd - \
    && mkdir /usr/local/oracle && cd /usr/local/oracle && unzip ~/instantclient-basic-linux.x64-19.5.0.0.0dbru.zip && unzip ~/instantclient-sdk-linux.x64-19.5.0.0.0dbru.zip && cd - \
    && cd / && find /usr/local/oracle/instantclient_19_5 -name \*.so\* -exec ln -s {} /usr/lib/. \; \
    && docker-php-ext-install -j$(nproc) bcmath bz2 calendar dba exif ffi gd gettext gmp intl ldap mysqli opcache pcntl pdo_mysql pdo_pgsql pgsql pspell shmop snmp soap sockets sysvmsg sysvsem sysvshm tidy xmlrpc xsl zend_test zip \
    && docker-php-ext-configure oci8 --with-oci8=instantclient,/usr/local/oracle/instantclient_19_5 \
    && docker-php-ext-install oci8 \
    && docker-php-ext-configure pdo_oci --with-pdo-oci=instantclient,/usr/local/oracle/instantclient_19_5 \
    && docker-php-ext-install pdo_oci \
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
    curl -L https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    curl -L https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
    apt update && \
    ACCEPT_EULA=Y apt install -y msodbcsql17 && \
    ACCEPT_EULA=Y apt install -y mssql-tools && \
    apt install -y unixodbc-dev && \
    pecl install sqlsrv-5.7.1preview && \
    docker-php-ext-enable sqlsrv && \
    pecl install pdo_sqlsrv-5.7.1preview && \
    docker-php-ext-enable pdo_sqlsrv && \
    echo /usr/local/clidriver | pecl install ibm_db2 && \
    docker-php-ext-enable ibm_db2 && \
    curl -L --url https://pecl.php.net/get/PDO_IBM-1.3.6.tgz -o ~/PDO_IBM-1.3.6.tgz && \
    cd ~ && tar xzf PDO_IBM-1.3.6.tgz && cd - && cd ~/PDO_IBM-1.3.6 && sed -i'' '126,139d' package.xml && phpize && ./configure --with-pdo-ibm=/usr/local/clidriver && make install && cd - \
    docker-php-ext-enable pdo_ibm && \
    docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr && \
    docker-php-ext-install pdo_odbc && \
    apt remove -y libssl-dev && \
    apt autoremove -y && \
    apt clean

# from: https://github.com/iagapie/docker/blob/master/php/fpm/7.3/Dockerfile
# (MIT LICENSE: https://github.com/iagapie/docker/blob/master/LICENSE)
RUN set -ex \
	&& docker-php-source extract \
	&& { \
        echo '# https://github.com/docker-library/php/issues/103#issuecomment-271413933'; \
        echo 'AC_DEFUN([PHP_ALWAYS_SHARED],[])dnl'; \
        echo; \
        cat /usr/src/php/ext/odbc/config.m4; \
    } > temp.m4 \
    && mv temp.m4 /usr/src/php/ext/odbc/config.m4 \
	&& docker-php-ext-configure odbc --with-unixODBC=shared,/usr \
	&& docker-php-ext-install -j$(nproc) odbc \
        && docker-php-source delete

RUN sed -i 's/# de_DE/de_DE/g' /etc/locale.gen
RUN sed -i 's/# en_US/en_US/g' /etc/locale.gen
RUN locale-gen 
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
RUN curl -L --url https://getcomposer.org/composer.phar -o /usr/local/bin/composer.phar && chmod a+x /usr/local/bin/composer.phar
RUN apt install wget
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN ln -s /root/.symfony/bin/symfony /usr/local/bin/.
ARG XDEBUG_REMOTE_HOST=localhost
RUN echo xdebug.remote_host=${XDEBUG_REMOTE_HOST} >> /usr/local/etc/php/conf.d/xdebug.ini
RUN composer.phar self-update
