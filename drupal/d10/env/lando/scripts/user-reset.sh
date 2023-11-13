#!/bin/bash

# Reset password for uid 1.

# php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} pmu password_policy -y
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} uublk `php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} --pipe uinf --uid=1 --fields=name`
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} upwd `php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} --pipe uinf --uid=1 --fields=name` admin
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} uli --uid=1
