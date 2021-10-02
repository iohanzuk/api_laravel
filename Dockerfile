FROM php:7.4-cli

ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone

ENV uid=1000

WORKDIR /app

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - 

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libldap2-dev \
    libfreetype6-dev \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    nodejs \
    graphviz \
    sqlite3 \
    libsqlite3-dev

RUN npm install -g yarn

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure ldap --with-ldap=yes \
    &&  docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql mysqli pdo_pgsql pdo_mysql pdo_sqlite mbstring zip exif pcntl gd ldap \
    && docker-php-ext-enable pdo_sqlite

RUN pecl install -o -f redis xdebug \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis xdebug

RUN echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >>  /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey=docker" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_log=/app/storage/logs/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.default_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini

         
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && composer self-update

RUN useradd -G root -u $uid -d /home/devuser devuser
RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser


RUN chown -R $uid:$uid /app

EXPOSE 8000

USER $uid