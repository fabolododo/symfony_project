FROM ubuntu:16.04

LABEL maintainer="Fabrice Latri <fabrice.latri@hotmail.fr>"

# RUN apt-get update && apt-get install -y --no-install-recommends \
# 		software-properties-common \
# 		supervisor \
# 	&& apt-get clean \
# 	&& rm -fr /var/lib/apt/lists/*

# RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php

RUN apt-get update && apt-get install -y --no-install-recommends \
        software-properties-common && \
        # supervisor && \
        LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php && \
        apt-get update && \
        apt-get install -y \
		libapache2-mod-php7.4 \
		php7.4 \
		php7.4-bcmath \
		php7.4-cli \
		php7.4-curl \
		php7.4-dev \
		php7.4-gd \
		php7.4-imap \
		php7.4-intl \
		php7.4-mbstring \
		php7.4-mysql \
		php7.4-pgsql \
		php7.4-pspell \
		php7.4-xml \
		php7.4-xmlrpc \
		php7.4-zip \
		php-xdebug \
		php-apcu \
		php-memcached \
		php-pear \
		php-redis \
        curl \
        apache2 \
        # mkdir -p /etc/supervisor/conf.d \
	&& apt-get clean \
	&& rm -fr /var/lib/apt/lists/*

RUN a2enmod rewrite

ENV APACHE_LOCK_DIR="/var/lock"
ENV APACHE_PID_FILE="/var/run/apache2.pid"
ENV APACHE_RUN_USER="www-data"
ENV APACHE_RUN_GROUP="www-data"
ENV APACHE_LOG_DIR="/var/log/apache2"

LABEL Description="Webserver php 7.4"

VOLUME /var/www/html

ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /usr/local/bin/
RUN curl -sS https://getcomposer.org/installer | php
RUN chmod +x composer.phar
RUN mv composer.phar composer
RUN composer self-update

WORKDIR /root
RUN echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# COPY /usr/bin/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

COPY apache2-foreground.sh /scripts/
RUN chmod +x /scripts/*


EXPOSE 80

CMD ["/scripts/apache2-foreground.sh"]