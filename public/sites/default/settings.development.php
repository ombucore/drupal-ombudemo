<?php
$databases = array (
  'default' =>
  array (
    'default' =>
    array (
      'database' => 'ombudemo',
      'username' => 'root',
      'password' => 'meh',
      'host' => 'localhost',
      'port' => '',
      'driver' => 'mysql',
      'prefix' => '',
    ),
  ),
);

$update_free_access = FALSE;

$drupal_hash_salt = '3QhjnBPnHeOAYAAD9CszCD1CZ1dxqXsA5iTupBK5Zvk';

ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);
ini_set('session.gc_maxlifetime', 200000);
ini_set('session.cookie_lifetime', 2000000);

$conf['environment'] = 'development';
