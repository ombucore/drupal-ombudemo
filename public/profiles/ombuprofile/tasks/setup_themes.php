<?php
// $id$

/**
 * Setup default theme settings.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_themes($install_state) {
  // Enable the default theme.
  $default_theme = OMBUBASE_DEFAULT_THEME;
  db_update('system')
    ->fields(array('status' => 1))
    ->condition('type', 'theme')
    ->condition('name', $default_theme)
    ->execute();
  variable_set('theme_default', $default_theme);

  // Enable the admin theme.
  $admin_theme = 'ombuadmin';
  db_update('system')
    ->fields(array('status' => 1))
    ->condition('type', 'theme')
    ->condition('name', $admin_theme)
    ->execute();
  variable_set('admin_theme', $admin_theme);
  variable_set('node_admin_theme', '1');

  // Other theme vars
  variable_set('default_logo', '0');
  //variable_set('logo_path', 'sites/all/themes/bmx_base/css/img/logo.png');
  //variable_set('site_frontpage', 'products');
  //variable_set('theme_bmx_catalog_settings', array(
      //'default_favicon' => false,
      //'favicon_path' => false,
  //));
}
