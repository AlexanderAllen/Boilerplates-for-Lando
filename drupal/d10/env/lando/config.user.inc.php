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

$cfg['MaxNavigationItems'] = 1000;
$cfg['NavigationTreeTableSeparator'] = '_';
$cfg['PmaAbsoluteUri'] = 'https://d10.pma.lndo.site';

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

?>
