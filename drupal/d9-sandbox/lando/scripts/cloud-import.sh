#!/bin/bash

# @file: Import dump into Azure cloud database.

# Parameters:
#
# $1: remote target database
# $2: database dump file

# For example:
# TARGETDB=upstream-db
# DUMP_FILE=db/prod011922.sql / drupal9-2022-01-27-UTC-22-32-47.sql

TARGETDB="${1}"
DUMP_FILE="${2}"

# https://stackoverflow.com/a/49379687/467453
# Use utf8 or .
CHARSET=utf8mb4

mysql \
--compress \
--reconnect \
--connect-timeout=1800 \
--default-character-set=$CHARSET \
--user="swaguser@BDenvmysql" \
--host="${BD_PMA_HOST}" \
--ssl-ca="${BD_PMA_SSLCA}" \
--password="${BD_PMA_PASS}" $TARGETDB < $DUMP_FILE

# Manual remote import.
# mysql \
# --compress \
# --reconnect \
# --connect-timeout=1800 \
# --default-character-set=utf8mb4 \
# --user="richard.allen@BDenvmysql" \
# --host="${BD_PMA_HOST}" \
# --ssl-ca="${BD_PMA_SSLCA}" \
# --password="${BD_PMA_PASS}" remote-db < db/drupal9-2022-01-27-UTC-22-32-47.sql

# Manual connect for verification.
# mysql \
# --compress \
# --default-character-set=utf8mb4 \
# --user="richard.allen@BDenvmysql" \
# --host="${BD_PMA_HOST}" \
# --ssl-ca="${BD_PMA_SSLCA}" \
# --password="${BD_PMA_PASS}"
