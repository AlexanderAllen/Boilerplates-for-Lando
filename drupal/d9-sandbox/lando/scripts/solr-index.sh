#!/bin/bash

# Search API index items.
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} sapi-sc lando
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} sapi-s
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} sapi-i
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} sapi-s
