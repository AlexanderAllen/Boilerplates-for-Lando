#!/bin/bash
# Enables environment variable in order to debug PHP CLI scripts (Drush).

# You can apply "last mile" XDebug overrides here.
export XDEBUG_CONFIG="log_level=1"


# https://stackoverflow.com/a/9057392/467453
export XDEBUG_SESSION=LANDO
php ${DRUPAL_VENDOR}/bin/drush --root=${DRUPAL_ROOT} "${@:1}"
