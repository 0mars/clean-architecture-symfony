# Based on https://github.com/docker-library/php/blob/35aedb29009b46af6ea1009c9405d01d3f66968e/7.2/alpine3.7/fpm/Dockerfile
FROM php:7.2.19-fpm-alpine
ARG TIMEZONE

ENV PHP_MEMORY_LIMIT 4000M

# Install required packages
RUN apk add --no-cache --virtual .build-deps git tzdata bash make autoconf build-base shadow

RUN docker-php-ext-install pdo

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN rm -rf /tmp/* /etc/apk/cache/*

RUN git config --global http.sslVerify false

# Configure timezone
RUN cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} >> ${PHP_INI_DIR}/php.ini
RUN printf '[PHP]\nmemory_limit = "%s"\n', ${PHP_MEMORY_LIMIT} > ${PHP_INI_DIR}/php.ini
RUN "date"


# Install xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


RUN chmod u+s /usr/local/sbin/php-fpm

ENV USER=docker
ENV UID=1000
ENV GID=1000

RUN addgroup --gid "$GID" "$USER" \
    && adduser \
    --disabled-password \
    --gecos "" \
    --home "$(pwd)" \
    --ingroup "$USER" \
    --no-create-home \
    --uid "$UID" \
    "$USER"

RUN sed -i s/'user = www-data'/'user = docker'/g /usr/local/etc/php-fpm.d/www.conf && \
    sed -i s/'group = www-data'/'group = docker'/g /usr/local/etc/php-fpm.d/www.conf && \
    sed -i s/';catch_workers_output = yes'/'catch_workers_output = yes'/g /usr/local/etc/php-fpm.d/www.conf && \
    sed -i s/';error_log = log\/php-fpm.log'/'error_log = \/proc\/self\/fd\/2'/g /usr/local/etc/php-fpm.conf


USER $USER

WORKDIR /srv/service
