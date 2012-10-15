<?php
$databases = array (
  'default' =>
  array (
    'default' =>
    array (
      'database' => '%%DB_DB%%',
      'username' => '%%DB_USER%%',
      'password' => '%%DB_PW%%',
      'host' => '%%DB_HOST%%',
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

// $conf['googlemap_api_key'] = 'ABQIAAAAzxNz3nbl0rwEoAf5Ppk2qhTFiIG9WPB99zZpPRSYGUEpFLzEuBQY9U1TEzIXsFHiDepQhF83D5C7lA';

$conf['environment'] = 'production';
