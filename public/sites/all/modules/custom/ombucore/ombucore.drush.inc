<?php

/**
 * @file
 * Drush integration for ombucore.
 */

/**
 * Implements hook_drush_command().
 */
function ombucore_drush_command() {
  $items['dump-roles-perms'] = array(
    'description' => dt('Dumps the current user roles and permissions into a file.'),
    'arguments' => array(),
  );
  $items['dump-formats'] = array(
    'description' => dt('Dumps the current filter formats.'),
    'arguments' => array(),
  );
  $items['dump-wysiwyg'] = array(
    'description' => dt('Dumps the current wysiwyg settings.'),
    'arguments' => array(),
  );
  $items['dump-variables'] = array(
    'description' => dt('Dumps variable settings.'),
    'arguments' => array(
      'name' => 'A string to filter the variables by. Variables whose name contains the string will be listed.',
    ),
    'examples' => array(
      'drush dump-variables' => 'Dump all variables and values.',
      'drush dump-variables user' => 'Dump all variables containing the string "user".',
      'drush dump-variables site_mail' => 'Dump the variable with the exact key "site_mail".',
    ),
  );
  $items['ombucore-load-up'] = array(
    'description' => dt('Helper command to load content from profile initial-content/ directory. Useful to test content creation without having to trigger a new build.'),
    'arguments' => array(
      'file' => 'The file name to load. Should exist in the [profile directory]/intial-content/ directory',
    ),
    'examples' => array(
      'drush ombucore-load-up page.php' => 'Run content insertion in page.php file.',
    ),
  );
  return $items;
}

/**
 * Command callback. Dump roles and permissions.
 *
 *   drush dump-roles-perms
 */
function drush_ombucore_dump_roles_perms() {
  $content = array();
  $roles = user_roles();

  foreach ($roles as $rid => $role) {
    $perms = user_role_permissions(array($rid => $role));
    $content[$role] = array_keys($perms[$rid]);
  }

  drush_ombucore_write_yml($content, 'roles');
}

/**
 * Command callback. Dump input formats.
 *
 *   drush dump-formats
 */
function drush_ombucore_dump_formats() {
  $formats = array();
  foreach (filter_formats() as $format_name => $format) {
    // Get the filters.
    $format->filters = filter_list_format($format_name);

    // Turn the filter objects into arrays.
    foreach ($format->filters as $filter_name => $filter_obj) {
      $format->filters[$filter_name] = (array) $filter_obj;
    }
    $formats[$format_name] = (array) $format;
  }

  drush_ombucore_write_yml($formats, 'formats');
}

/**
 * Command callback. Dump wysiwyg settings.
 *
 *   drush dump-wysiwyg
 */
function drush_ombucore_dump_wysiwyg() {
  foreach (wysiwyg_profile_load_all() as $profile_name => $profile) {
    $wysiwyg[$profile_name] = (array) $profile;
  }

  drush_ombucore_write_yml($wysiwyg, 'wysiwyg');
}

/**
 * Command callback. Dump variable settings.
 *
 *   drush dump-settings
 */
function drush_ombucore_dump_variables() {
  // Retrieve variables from drush.
  $settings = call_user_func_array('drush_variable_get', func_get_args());

  $profile = variable_get('install_profile', '');

  // Handle special case of variables, since they are only additive.
  ombucore_autoload();
  $dumper = new Symfony\Component\Yaml\Dumper();
  $parser = new Symfony\Component\Yaml\Parser();

  $export_file_path = drupal_get_path('profile', $profile) . '/config/variables.yml';

  // Make sure directory exists and is writable.
  file_prepare_directory(dirname($export_file_path), FILE_CREATE_DIRECTORY);

  $overrides = $parser->parse(file_get_contents($export_file_path));
  $overrides['add'] = $settings + $overrides['add'];

  $yaml = $dumper->dump($overrides, 5);
  file_put_contents($export_file_path, $yaml);
}

/**
 * Writes a yml file to disk.
 *
 * Will write any additions and/or deletions as overrides to profile config
 * directory.
 *
 * @param array $settings
 *   New settings for $base_name config.
 * @param string $base_name
 *   The name of the configuration.
 */
function drush_ombucore_write_yml($settings, $base_name) {
  ombucore_autoload();
  $dumper = new OmbuCore\Settings\Dumper($base_name, variable_get('install_profile', ''));

  $export_file_path = $dumper->getFilePath();

  if (file_exists($export_file_path)) {
    if (!drush_confirm(dt("The file $export_file_path already exists.\nWould you like to overwrite it?"))) {
      drush_die('Aborting.');
    }
  }

  $dumper->dump($settings);

  drush_print(ucwords($base_name) . ' settings written to: ' . $export_file_path);
}

/**
 * Helper command to load up initial content build without a full rebuild.
 *
 * @param string $file
 *  File name to run.
 */
function drush_ombucore_load_up($filename) {
  $profile = variable_get('install_profile', '');
  $file_path = drupal_get_path('profile', $profile) . '/initial-content/';

  if (!is_dir($file_path) || !is_file($file_path . $filename)) {
    $message = dt('The file !file cannot be found', array(
      '!file' => $file_path . $filename,
    ));
    drush_die($message);
  }

  ombucore_autoload();
  include $file_path . $filename;

  // Assume $wrapper exists in content script.
  if (isset($wrapper)) {
    $message = dt('Created node: !title (!path)', array(
      '!title' => $wrapper->title->value(),
      '!path' => url('node/' . $wrapper->nid->value()),
    ));
    drush_print($message);
  }
}

