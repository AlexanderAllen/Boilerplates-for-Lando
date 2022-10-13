<?php

// @codingStandardsIgnoreFile

$databases = [];
// $databases['default']['default'] = [
//    'database' => 'drupal9',
//    'username' => 'drupal9',
//    'password' => 'drupal9',
//    'host' => 'database',
//    'driver' => 'mysql',
// ];

$databases['default']['default'] = array (
  'database' => 'drupal9',
  'username' => 'drupal9',
  'password' => 'drupal9',
  'prefix' => '',
  'host' => 'database',
  'port' => '',
  'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
  'driver' => 'mysql',
  'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
);

// Inside project root.
// $settings['config_sync_directory'] = '/app/src/config';

// Outside project root.
$settings['config_sync_directory'] = '/app/container/config';

$settings['hash_salt'] = 'salty-gnome';

$settings['file_public_path'] = 'sites/default/files';

// The default entity_update_batch_size is 50.
// core/modules/system/system.post_update.php, system_post_update_sort_all_config().
// Settings::get('entity_update_batch_size', 50);
//
// Increase batch size a tad to speed up debugging.
$settings['entity_update_batch_size'] = 325;


// Clear trusted host warning for Lando.
// https://www.drupal.org/docs/installing-drupal/trusted-host-settings
$settings['trusted_host_patterns'] = [
  '^localhost$',
  '.*\.lndo\.site$',
];

// Drupal file upload by anonymous or untrusted users into public file systems -- PSA-2016-003
// https://www.drupal.org/psa-2016-003
// https://www.drupal.org/docs/8/core/modules/file/overview
$settings['file_private_path'] = 'sites/bd9.lndo.site/private';
// $settings['file_private_path'] = $app_root . '/../private';
$settings['file_temp_path'] = '/tmp';
$settings['file_private_path'] = '/app/src/private';

/**
 * Assertions.
 *
 * The Drupal project primarily uses runtime assertions to enforce the
 * expectations of the API by failing when incorrect calls are made by code
 * under development.
 *
 * @see http://php.net/assert
 * @see https://www.drupal.org/node/2492225
 *
 * If you are using PHP 7.0 it is strongly recommended that you set
 * zend.assertions=1 in the PHP.ini file (It cannot be changed from .htaccess
 * or runtime) on development machines and to 0 in production.
 *
 * @see https://wiki.php.net/rfc/expectations
 */
assert_options(ASSERT_ACTIVE, TRUE);
\Drupal\Component\Assertion\Handle::register();

/**
 * Enable local development services.
 */
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

/**
 * Show all error messages, with backtrace information.
 *
 * In case the error level could not be fetched from the database, as for
 * example the database connection failed, we rely only on this value.
 */
$config['system.logging']['error_level'] = 'verbose';

/**
 * Disable CSS and JS aggregation.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

/**
 * Disable the render cache.
 *
 * Note: you should test with the render cache enabled, to ensure the correct
 * cacheability metadata is present. However, in the early stages of
 * development, you may want to disable it.
 *
 * This setting disables the render cache by using the Null cache back-end
 * defined by the development.services.yml file above.
 *
 * Only use this setting once the site has been installed.
 */
$settings['cache']['bins']['render'] = 'cache.backend.null';

/**
 * Disable caching for migrations.
 *
 * Uncomment the code below to only store migrations in memory and not in the
 * database. This makes it easier to develop custom migrations.
 */
$settings['cache']['bins']['discovery_migration'] = 'cache.backend.memory';

/**
 * Disable Internal Page Cache.
 *
 * Note: you should test with Internal Page Cache enabled, to ensure the correct
 * cacheability metadata is present. However, in the early stages of
 * development, you may want to disable it.
 *
 * This setting disables the page cache by using the Null cache back-end
 * defined by the development.services.yml file above.
 *
 * Only use this setting once the site has been installed.
 */
$settings['cache']['bins']['page'] = 'cache.backend.null';

/**
 * Disable Dynamic Page Cache.
 *
 * Note: you should test with Dynamic Page Cache enabled, to ensure the correct
 * cacheability metadata is present (and hence the expected behavior). However,
 * in the early stages of development, you may want to disable it.
 */
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

/**
 * Skip file system permissions hardening.
 *
 * The system module will periodically check the permissions of your site's
 * site directory to ensure that it is not writable by the website user. For
 * sites that are managed with a version control system, this can cause problems
 * when files in that directory such as settings.php are updated, because the
 * user pulling in the changes won't have permissions to modify files in the
 * directory.
 */
$settings['skip_permissions_hardening'] = TRUE;

/**
 * Load local development override configuration, if available.
 *
 * Create a settings.local.php file to override variables on secondary (staging,
 * development, etc.) installations of this site.
 *
 * Typical uses of settings.local.php include:
 * - Disabling caching.
 * - Disabling JavaScript/CSS compression.
 * - Rerouting outgoing emails.
 *
 * Keep this code block at the end of this file to take full effect.
 */

if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}

if (file_exists($app_root . '/' . $site_path . '/memcache.lando.php')) {
  include $app_root . '/' . $site_path . '/memcache.lando.php';
}
