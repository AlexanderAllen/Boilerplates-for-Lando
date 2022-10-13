#!/bin/bash

# utf8_general_ci # preferred drupal collation in general
# --ignore-table-data # add this for the caches

# References
# https://stackoverflow.com/a/62791811/467453
# https://www.drupal.org/forum/support/installing-drupal/2019-04-04/database-collation-which-is-correct

TARGETDB=BDdev01
DUMP_NAME=$TARGETDB-`date +"%F-%Z-%T"`

mysqldump \
--no-tablespaces --single-transaction --add-drop-table --compress \
--password=${BD_PMA_PASS} \
--host=${BD_PMA_HOST} \
--port=${BD_PMA_PORT} \
--ssl-ca=${BD_PMA_SSLCA} \
--user=${BD_PMA_USER} \
--set-charset=utf8 \
--ignore-table-data=$TARGETDB.cache_bootstrap \
--ignore-table-data=$TARGETDB.cache_config \
--ignore-table-data=$TARGETDB.cache_container \
--ignore-table-data=$TARGETDB.cache_data \
--ignore-table-data=$TARGETDB.cache_default \
--ignore-table-data=$TARGETDB.cache_discovery \
--ignore-table-data=$TARGETDB.cache_discovery_migration \
--ignore-table-data=$TARGETDB.cache_dynamic_page_cache \
--ignore-table-data=$TARGETDB.cache_entity \
--ignore-table-data=$TARGETDB.cache_library \
--ignore-table-data=$TARGETDB.cache_menu \
--ignore-table-data=$TARGETDB.cache_migrate \
--ignore-table-data=$TARGETDB.cache_page \
--ignore-table-data=$TARGETDB.cache_render \
--ignore-table-data=$TARGETDB.cache_toolbar \
--ignore-table-data=$TARGETDB.flood \
--ignore-table-data=$TARGETDB.watchdog \
$TARGETDB > $DUMP_NAME.sql
