#!/bin/bash

# References
# https://stackoverflow.com/a/62791811/467453
# https://www.drupal.org/forum/support/installing-drupal/2019-04-04/database-collation-which-is-correct

# XZ (LZMA):https://manpages.debian.org/buster/xz-utils/xz.1.en.html
# LZ4: https://manpages.debian.org/testing/lz4/lz4.1.en.html

TARGETDB=${APP_DB_NAME}
DATE=`date +"%F-%Z-%H-%M-%S"`
TAG_NAME=$TARGETDB-$DATE
DUMP_NAME=$TAG_NAME.sql.lz4

# ../backups is not mounted yet to Lando.
#DESTINATION=../backups
DESTINATION=/app/db

echo "Dumping ${TARGETDB} into ${DUMP_NAME}"

mysqldump \
--no-tablespaces --single-transaction --add-drop-table \
--host=database \
--port=3306 \
--user=${APP_DB_ROOTUSER} \
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
$TARGETDB | lz4 --fast > $DESTINATION/$DUMP_NAME

echo "Dump complete"
ls -lah $DESTINATION/$DUMP_NAME

git tag $TAG_NAME
echo "Tagged last commit with $TAG_NAME"
