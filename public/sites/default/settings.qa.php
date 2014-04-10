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

$conf['environment'] = 'development';

// Sentry DSN.
$conf['sentry_dsn'] = 'https://cb1a67fc4f31421bb958fcf6167a0f3d:d6e122d152eb42889299366dcecb3aee@app.getsentry.com/8398';

// Caching on qa.
$conf['cache'] = 1;
$conf['preprocess_css'] = 1;
$conf['preprocess_js'] = 1;
