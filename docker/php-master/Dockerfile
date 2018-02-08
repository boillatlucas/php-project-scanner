FROM php:7.2-fpm

ARG USER_PUID=1000
ARG USER_PGID=1000
ARG USER_PNAME=app

RUN apt-get update

# Install libraries, utils
RUN apt-get install -y librabbitmq-dev zlib1g-dev libicu-dev g++ cron wget zlibc libsodium-dev libgmp-dev

# Install amqp to use queue system like RabbitMQ
RUN pecl install amqp

# Install php extensions
RUN docker-php-ext-install -j$(nproc) zip bcmath pdo_mysql intl gmp sodium && \
    docker-php-ext-enable zip bcmath pdo_mysql amqp intl gmp sodium

COPY ./laravel.ini /usr/local/etc/php/conf.d


RUN apt-get clean

# Create then add group docker to www-data (use in application to share docker socket)
RUN groupadd --gid=999 docker
RUN groupadd --gid=1000 $USER_PNAME
RUN usermod -a -G docker www-data

RUN adduser --gecos '' --disabled-password --gid $USER_PGID --uid $USER_PUID $USER_PNAME
RUN usermod -a -G docker www-data
RUN usermod -a -G docker $USER_PNAME

WORKDIR /tmp
COPY script/composer-install.sh /tmp/
RUN /tmp/composer-install.sh && \
    rm /tmp/composer-install.sh && \
    mv /tmp/composer.phar /usr/local/bin/composer && \
    chown $USER_PNAME:www-data /usr/local/bin/composer

# Fix permission
RUN chown -R $USER_PNAME:www-data /var/www

CMD cron && \
    php /var/www/artisan migrate --seed && \
    php /var/www/artisan passport:install && \
    php-fpm

WORKDIR /var/www

EXPOSE 9000
