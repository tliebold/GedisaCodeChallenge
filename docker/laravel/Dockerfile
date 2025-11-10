FROM php:8.4-cli-bookworm

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node:20-bookworm-slim /usr/local /usr/local

RUN chsh -s /bin/bash

RUN apt-get update

RUN apt-get install -y \
    libzip-dev \
    git

RUN docker-php-ext-install  \
    pdo  \
    pdo_mysql  \
    pcntl \
    zip

RUN useradd -u 1000 docker
RUN mkdir /home/docker
RUN chown docker:docker /home/docker
