# Custom image for BRCTV.
#
# To see how custom image thingamagiks work for Lando, 
# please see https://docs.lando.dev/config/services.html#overrides.

# Current BRCTV: FROM php:7.2-apache
# Previous Lando: FROM devwithlando/php:7.2-apache
#
# Targets Lando image for PHP 7.4.
FROM devwithlando/php:7.4-apache-4

# Mirror depedencies from BRCTVD8 web.dockerfile.
ENV build_deps \
    libpng-dev \
    libjpeg-dev

ENV run_deps \
    sendmail

ENV apache_mods \
    headers \
    lbmethod_byrequests \
    lbmethod_bytraffic \
    lbmethod_bybusyness \
    lbmethod_heartbeat \
    proxy \
    proxy_connect \
    proxy_ftp \
    proxy_http \
    proxy_fcgi \
    proxy_scgi \
    proxy_uwsgi \
    proxy_fdpass \
    proxy_wstunnel \
    proxy_ajp \
    proxy_balancer \
    proxy_express \
    proxy_hcheck \
    ssl \
    slotmem_shm \
    rewrite \
    vhost_alias

RUN \
    apt-get update \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y $build_deps $run_deps \
    # Additional PHP configuration.
    # https://github.com/docker-library/php/issues/931#issuecomment-568658449
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && docker-php-ext-install exif \
    && rm -r /var/lib/apt/lists/* \
    && apt-get purge -y --auto-remove $buildDeps \    
    && a2enmod $apache_mods

# Install Drupal Console.
RUN curl https://drupalconsole.com/installer -L -o drupal.phar \
    && mv drupal.phar /usr/local/bin/drupal \
    && chmod +x /usr/local/bin/drupal

# Copy server configs - needed for client API calls.
# See brctvd8/env.inc
RUN mkdir -p /usr/local/web-application-vars/brctvd8
COPY brctvd8/env.inc /usr/local/web-application-vars/brctvd8/
