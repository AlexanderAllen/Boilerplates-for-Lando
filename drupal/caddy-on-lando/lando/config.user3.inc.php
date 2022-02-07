<?php

/**
 * Custom configuration file for PMA container.
 * References:
 * - https://docs.phpmyadmin.net/en/latest/config.html
 * - http://localhost:60260/doc/html/config.html#cfg_Servers_ssl_ca
 */

// Environment variables passed from Lando private.env.
// $env = &$_SERVER;

declare(strict_types=1);
$cfg['blowfish_secret'] = 'nm8p94D3ZtcAdoEtYz32sEdka7fsUyQ3';


/**
 * Servers configuration
 */
$i = 0;

/**
 * First server
 */
$i++;
/* Authentication type */
$cfg['Servers'][$i]['auth_type'] = 'cookie';
/* Server parameters */

$cfg['Servers'][$i]['verbose'] = 'lando database';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = true;
$cfg['Servers'][$i]['host'] = 'database';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['nopassword'] = true;


# https://docs.phpmyadmin.net/en/latest/config.html#server-connection-settings
$i++;
$cfg['Servers'][$i]['verbose'] = 'pma remote';
$cfg['Servers'][$i]['compress'] = true;
$cfg['Servers'][$i]['AllowNoPassword'] = true;
$cfg['Servers'][$i]['host'] = $_ENV['PROJECT_PMA_HOST'];
$cfg['Servers'][$i]['user'] = $_ENV['PROJECT_PMA_USER'];
$cfg['Servers'][$i]['port'] = $_ENV['PROJECT_PMA_PORT'];
$cfg['Servers'][$i]['password'] = $_ENV['PROJECT_PMA_PASS'];
$cfg['Servers'][$i]['ssl_ca'] = $_ENV['PROJECT_PMA_SSLCA'];
$cfg['Servers'][$i]['ssl'] = true;
$cfg['Servers'][$i]['ssl_verify'] = false;
$cfg['Servers'][$i]['auth_type'] = 'config';


?>
