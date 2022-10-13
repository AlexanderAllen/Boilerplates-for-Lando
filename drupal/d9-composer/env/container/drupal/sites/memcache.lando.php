<?php

// @codingStandardsIgnoreFile

/**
 * MEMCACHED CONFIGURATION
 * - https://www.valuebound.com/resources/blog/configuring-memcache-drupal-8-to-reduce-database-load
 * - https://docs.platform.sh/guides/drupal9/memcached.html
 */

// By default Drupal starts the cache_container on the database. The following
// code overrides that.
// Make sure that the $class_load->addPsr4 is pointing to the right location of
// the Memcache module. The value below should be correct if Memcache was installed
// using Drupal Composer.
$memcache_exists = class_exists('Memcache', FALSE);
$memcached_exists = class_exists('Memcached', FALSE);
if ($memcache_exists || $memcached_exists) {

  // See src/web/modules/contrib/memcache/example.services.yml.
  // Default services enabled when enabling the module, no need for this line.
  // $settings['container_yamls'][] = $app_root . '/modules/contrib/memcache/memcache.services.yml';

  // Example services causing issues with config imports (lock related).
  // $settings['container_yamls'][] = $app_root . '/modules/contrib/memcache/example.services.yml';

  // Make sure that the $class_load->addPsr4 is pointing to the right location of
  // the Memcache module. The value below should be correct if Memcache was installed
  // using Drupal Composer.
  $class_loader->addPsr4('Drupal\\memcache\\', 'modules/contrib/memcache/src');

  // Set’s default cache storage as Memcache and excludes database connection for cache
  $settings['cache']['default'] = 'cache.backend.memcache';
  // Set’s Memcache key prefix for your site and useful in working sites with same memcache as backend.
  $settings['memcache_storage']['key_prefix'] = '';
  // Set’s Memcache storage server’s.
  $settings['memcache_storage']['memcached_servers'] =  ['memcached:11211' => 'default'];

  // By default Drupal starts the cache_container on the database. The following
  // code overrides that.

  // Define custom bootstrap container definition to use Memcache for cache.container.
  $settings['bootstrap_container_definition'] = [
    'parameters' => [],
    'services' => [
      'database' => [
        'class' => 'Drupal\Core\Database\Connection',
        'factory' => 'Drupal\Core\Database\Database::getConnection',
        'arguments' => ['default'],
      ],
      'settings' => [
        'class' => 'Drupal\Core\Site\Settings',
        'factory' => 'Drupal\Core\Site\Settings::getInstance',
      ],
      'memcache.settings' => [
        'class' => 'Drupal\memcache\MemcacheSettings',
        'arguments' => ['@settings'],
      ],
      'memcache.factory' => [
        'class' => 'Drupal\memcache\Driver\MemcacheDriverFactory',
        'arguments' => ['@memcache.settings'],
      ],
      'memcache.timestamp.invalidator.bin' => [
        'class' => 'Drupal\memcache\Invalidator\MemcacheTimestampInvalidator',
        # Adjust tolerance factor as appropriate when not running memcache on localhost.
        'arguments' => ['@memcache.factory', 'memcache_bin_timestamps', 0.001],
      ],
      'memcache.backend.cache.container' => [
        'class' => 'Drupal\memcache\DrupalMemcacheInterface',
        'factory' => ['@memcache.factory', 'get'],
        'arguments' => ['container'],
      ],
      'lock.container' => [
        'class' => 'Drupal\memcache\Lock\MemcacheLockBackend',
        'arguments' => ['container', '@memcache.backend.cache.container'],
      ],
      'cache_tags_provider.container' => [
        'class' => 'Drupal\Core\Cache\DatabaseCacheTagsChecksum',
        'arguments' => ['@database'],
      ],
      'cache.container' => [
        'class' => 'Drupal\memcache\MemcacheBackend',
        'arguments' => ['container', '@memcache.backend.cache.container','@cache_tags_provider.container','@memcache.timestamp.invalidator.bin'],
      ],
    ],
  ];
}