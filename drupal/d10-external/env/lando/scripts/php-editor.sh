# Install PHP dependencies needed for development
# with Alpine WSL and Visual Studio Code.
#
# Reference: https://alexanderallen.medium.com/visual-studio-code-wsl-running-php-intellisense-from-alpine-linux-on-windows-10-78e8a990f1cc
#
# Install extensions for chrome from JetBrains:
# - https://www.jetbrains.com/help/phpstorm/browser-debugging-extensions.html
# - https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc

# Make sure VSC settings.json points to PHP:
# {
#    "php.memoryLimit": "2G",
#    "php.executablePath": "/usr/bin/php",
# }

# Make sure /etc/php$PHP_MAJOR/conf.d/xdebug.ini contains the following:
# https://xdebug.org/docs/all_settings#xdebug.mode
#
# zend_extension=xdebug.so
# xdebug.mode=develop,debug,coverage


PHP_MAJOR=7

sudo apk update
sudo apk add \
    php$PHP_MAJOR \
    php$PHP_MAJOR-json \
    php$PHP_MAJOR-pecl-xdebug \
    php$PHP_MAJOR-tokenizer \
    php$PHP_MAJOR-openssl \
    php$PHP_MAJOR-phar \
    php$PHP_MAJOR-mbstring \
    php$PHP_MAJOR-xmlwriter \
    php$PHP_MAJOR-simplexml

sudo ln -s /usr/bin/php7 /usr/bin/php

# Install PHPCS dependencies.
composer global require squizlabs/php_codesniffer:3.6.2
composer global require drupal/coder

# sudo echo "zend_extension=xdebug.so" >> /etc/php7/conf.d/xdebug.ini

# Make sure to add this to your global PATH
# export PATH="$PATH:$HOME/.config/composer/vendor/bin"
