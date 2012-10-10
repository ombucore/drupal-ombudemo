<?php

/**
 * @file
 * Drush integration for ombuprofile.
 */

/**
 * Implements hook_drush_command().
 */
function ombuprofile_drush_command() {
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
  return $items;
}

/**
 * Command callback. Dump roles and permissions
 *
 *   drush dump-roles-perms
 */
function drush_ombuprofile_dump_roles_perms() {
  $install_profile = variable_get('install_profile', 'ombuprofile');
  $export_file_path = drupal_get_path('profile', $install_profile) .'/'. $install_profile.'.roles.inc';
  if (file_exists($export_file_path)) {
    if (!drush_confirm(dt("The file $export_file_path already exists.\nWould you like to overwrite it?"))) {
      drush_die('Aborting.');
    }
  }

  $content = array();
  $roles = user_roles();

  foreach ($roles as $rid => $role) {
    $perms = user_role_permissions(array($rid => $role));
    $content[$role] = array_keys($perms[$rid]);
  }

  $file_contents = "<?php \n\n \$roles_perms = ". var_export($content, TRUE) .';';
  $result = file_put_contents($export_file_path, $file_contents);
  drush_print('Users and Roles written to: '. $export_file_path);
}

/**
 * Command callback. Dump input formats
 *
 *   drush dump-formats
 */
function drush_ombuprofile_dump_formats() {
  $install_profile = variable_get('install_profile', 'ombuprofile');
  $export_file_path = drupal_get_path('profile', $install_profile) .'/'. $install_profile.'.formats.inc';
  if (file_exists($export_file_path)) {
    if (!drush_confirm(dt("The file $export_file_path already exists.\nWould you like to overwrite it?"))) {
      drush_die('Aborting.');
    }
  }

  $formats = array();
  foreach (filter_formats() as $format_name => $format) {
    // get the filters
    $format->filters = filter_list_format($format_name);

    // turn the filter objects into arrays
    foreach ($format->filters as $filter_name => $filter_obj) {
      $format->filters[$filter_name] = (array) $filter_obj;
    }
    $formats[$format_name] = (array) $format;
  }

  $file_contents = "<?php \n\n ";
  $file_contents .= "\$formats = ". var_export($formats, TRUE) .';';
  $result = file_put_contents($export_file_path, $file_contents);
  drush_print('Formats written to: '. $export_file_path);
}

/**
 * Command callback. Dump wysiwyg settings
 *
 *   drush dump-wysiwyg
 */
function drush_ombuprofile_dump_wysiwyg() {
  $install_profile = variable_get('install_profile', 'ombuprofile');
  $export_file_path = drupal_get_path('profile', $install_profile) .'/'. $install_profile.'.wysiwyg.inc';
  if (file_exists($export_file_path)) {
    if (!drush_confirm(dt("The file $export_file_path already exists.\nWould you like to overwrite it?"))) {
      drush_die('Aborting.');
    }
  }

  foreach (wysiwyg_profile_load_all() as $profile_name => $profile) {
    $wysiwyg[$profile_name] = (array) $profile;
  }

  $file_contents = "<?php \n\n ";
  $file_contents .= "\$wysiwyg = ". var_export($wysiwyg, TRUE) .';';
  $result = file_put_contents($export_file_path, $file_contents);
  drush_print('WYSIWYG settings written to: '. $export_file_path);
}

