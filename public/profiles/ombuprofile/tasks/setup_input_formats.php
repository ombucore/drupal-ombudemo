<?php
// $Id$

/**
 * Setup default input formats.
 *
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_input_formats($install_state) {

  // load the formats
  ombuprofile_load_formats_from_dump();

  // load the wysiwyg settings
  ombuprofile_load_wysiwyg_from_dump();

}

function ombuprofile_load_formats_from_dump() {
  require(drupal_get_path('profile', 'ombuprofile') .'/ombuprofile.formats.inc');

  foreach ($formats as $format_name => $format) {
    $format = (object) $format;
    filter_format_save($format);
  }
}

function ombuprofile_load_wysiwyg_from_dump() {
  require(drupal_get_path('profile', 'ombuprofile') .'/ombuprofile.wysiwyg.inc');

  foreach ($wysiwyg as $wysiwyg_name => $object) {
    db_insert('wysiwyg')
      ->fields(array(
        'format' => $object['format'],
        'editor' => $object['editor'],
        'settings' => serialize($object['settings']),
      ))
      ->execute();
  }
}

