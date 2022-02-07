#!/bin/bash

lando destroy -y
lando start
lando db-import-plain
lando drush config:import -y

# Disable any backported Solr index from production here.
# lando drush search-api:server-disable production

echo "Indexing your newly imported database..."
echo "~ Thank you for your patience ~"
lando drush search-api:index

# Show Solr status
echo "Your current search server is:"
lando drush search-api:server-list
echo "Your current search index is:"
lando drush search-api:list
echo "Your index status is:"
lando drush search-api:status

# Provide courtesy login link.
echo "You may now login to your fresh Drupal install using the following link:"
lando admin
