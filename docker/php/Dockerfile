FROM php:8-fpm-alpine

ARG UID
ARG GID

RUN apk update && apk upgrade && apk add --no-cache bash

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir /.composer
RUN chmod -R 0777 /.composer

WORKDIR /app

COPY . .

RUN addgroup -g ${UID} arena && adduser -D -u ${GID} -G arena arena
RUN mkdir -p /home/arena/.ssh
RUN chmod 600 -R /home/arena/.ssh
RUN chown -R arena:arena /home/arena/.ssh

USER arena