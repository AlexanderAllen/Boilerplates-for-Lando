#!/bin/bash

php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} cr
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} cron -y
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} updb -y
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} config:import -y
