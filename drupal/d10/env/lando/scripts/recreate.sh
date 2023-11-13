#!/bin/bash

lando destroy -y
lando start
lando composer --no-interaction install
lando db-import brctvd8/init.sql
lando schema-updates

lando composer require --dev drupal/twig_xdebug drupal/admin_toolbar
lando drush en -y twig_xdebug admin_toolbar

# Required for phpunit time limits
lando composer require --dev phpunit/php-invoker

# Login link at end of re-create.
lando admin
