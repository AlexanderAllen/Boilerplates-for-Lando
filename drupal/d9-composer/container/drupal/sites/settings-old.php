<?php

// @codingStandardsIgnoreFile

$databases = [];
$databases['default']['default'] = [
   'database' => 'drupal9',
   'username' => 'drupal9',
   'password' => 'drupal9',
   'host' => 'database',
   'driver' => 'mysql',
];

$settings['config_sync_directory'] = './config/sync';

$settings['hash_salt'] = 'salty-gnome';

$settings['file_public_path'] = 'sites/bd9.lndo.site/files';

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
  '^bd9\.lndo\.site$',
];

// Drupal file upload by anonymous or untrusted users into public file systems -- PSA-2016-003
// https://www.drupal.org/psa-2016-003
// https://www.drupal.org/docs/8/core/modules/file/overview
$settings['file_private_path'] = 'sites/bd9.lndo.site/private';
// $settings['file_private_path'] = $app_root . '/../private';
