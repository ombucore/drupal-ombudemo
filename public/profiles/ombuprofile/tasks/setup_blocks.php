<?php
// $Id$

/**
 * Setup site blocks.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_blocks($install_state) {
  // Enable some standard blocks.
  $default_theme = variable_get('theme_default', OMBUBASE_DEFAULT_THEME);
  $admin_theme = variable_get('admin_theme', 'seven');

  // Since this task runs after modules have been enabled, all blocks will be
  // setup to use the default theme.  So blocks in the default theme need to be
  // updated, while blocks for the admin theme need to be inserted.
  $default_blocks = array(
    array(
      'module' => 'system',
      'delta' => 'main',
      'theme' => $default_theme,
      'status' => 1,
      'weight' => 0,
      'region' => 'content',
      'pages' => '',
      'cache' => -1,
    ),
    array(
      'module' => 'system',
      'delta' => 'help',
      'theme' => $default_theme,
      'status' => 1,
      'weight' => 0,
      'region' => 'help',
      'pages' => '',
      'cache' => -1,
    ),
    array(
      'module' => 'ombuprofile',
      'delta' => 'login',
      'theme' => $default_theme,
      'status' => 1,
      'weight' => 1,
      'region' => 'footer',
      'pages' => '',
    ),
    array(
      'module' => 'search',
      'delta' => 'form',
      'theme' => $default_theme,
      'status' => 1,
      'weight' => 2,
      'region' => 'footer',
      'pages' => '',
      'title' => 'Search Site:',
    ),
  );
  foreach ($default_blocks as $record) {
    $query = db_update('block');
    $query->fields($record);
    $query->condition('module', $record['module']);
    $query->condition('delta', $record['delta']);
    $query->execute();
  }

  // New module blocks to insert.
  $new_blocks = array(
    array(
      'module' => 'system',
      'delta' => 'main',
      'theme' => $admin_theme,
      'status' => 1,
      'weight' => 0,
      'region' => 'content',
      'pages' => '',
      'cache' => -1,
    ),
    array(
      'module' => 'system',
      'delta' => 'help',
      'theme' => $admin_theme,
      'status' => 1,
      'weight' => 0,
      'region' => 'help',
      'pages' => '',
      'cache' => -1,
    ),
    array(
      'module' => 'user',
      'delta' => 'login',
      'theme' => $admin_theme,
      'status' => 1,
      'weight' => 10,
      'region' => 'content',
      'pages' => '',
      'cache' => -1,
    ),
  );
  $query = db_insert('block')->fields(array('module', 'delta', 'theme', 'status', 'weight', 'region', 'pages', 'cache'));
  foreach ($new_blocks as $record) {
    $query->values($record);
  }
  $query->execute();

  // Create new blocks
  $delta = db_insert('block_custom')
    ->fields(array(
      'body' => 'Block Body',
      'info' => 'Block Info',
      'format' => 'php_code',
    ))
    ->execute();
  $query = db_insert('block')
    ->fields(array(
      'visibility' => 0,
      'pages' => '',
      'title' => 'Block Title',
      'module' => 'block',
      'theme' => variable_get('theme_default', ''),
      'status' => 0,
      'weight' => 0,
      'region' => -1,
      'delta' => $delta,
      'cache' => DRUPAL_NO_CACHE,
    ))
    ->execute();
}
