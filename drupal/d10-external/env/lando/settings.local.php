<?php
// @codingStandardsIgnoreFile

// https://docs.lando.dev/guides/lando-info.html#using-php
$LANDO = json_decode(getenv('LANDO_INFO'), TRUE);
$WEB_ROOT = getenv('LANDO_WEBROOT');
$LANDO_APP_NAME = getenv('LANDO_APP_NAME');

// print_r(array_keys($lando));
// print_r($lando['appserver']);
// print_r($lando['database']['creds']);

$databases = [];
$databases['default']['default'] = [
   'database' => $LANDO['database']['creds']['database'],
   'username' => $LANDO['database']['creds']['user'],
   'password' => $LANDO['database']['creds']['password'],
   'host' => 'database',
   'driver' => 'mysql',
];

$settings['config_sync_directory'] = '/app/config/sync';

// Clear trusted host warning for Lando.
// https://www.drupal.org/docs/installing-drupal/trusted-host-settings
$settings['trusted_host_patterns'] = [
  '^localhost$',
  "^${LANDO_APP_NAME}\.lndo\.site$",
  // "^app\.${LANDO_APP_NAME}\.lndo\.site$",
  "^d10$",
];

$settings['file_public_path'] = $WEB_ROOT . '/sites/default/files';
$settings['file_private_path'] = "/opt/${LANDO_APP_NAME}/private";
$settings['hash_salt'] = "/opt/${LANDO_APP_NAME}/private/salt.txt";

# Override production with development container, disables twig cache, amongst
# other settings.
# https://www.drupal.org/node/2598914
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';
// $settings['container_yamls'][] = DRUPAL_ROOT . '/development.services.yml';

$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;
$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
$settings['cache']['bins']['page'] = 'cache.backend.null';
$settings['skip_permissions_hardening'] = TRUE;

# Dynamic XDebug host address for WSL. this is too late
# ini_set('xdebug.client_host', '1');
# $xdebug_host = file_get_contents("/opt/${LANDO_APP_NAME}/XDEBUG_REMOTE_HOST");
