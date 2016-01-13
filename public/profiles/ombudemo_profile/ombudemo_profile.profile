<?php

/**
 * @file
 * Base OMBU Demo Profile.
 */

/**
 * Implements hook_form_alter().
 *
 * Hides the "Width" page section dropdown since the demo theme doesn't support
 * widths on sections.
 */
function ombudemo_profile_form_alter(&$form, &$form_state, $form_id) {
  if (isset($form['field_sections'])) {
    foreach (element_children($form['field_sections']['und']) as $i) {
      $form['field_sections']['und'][$i]['settings']['width']['#access'] = FALSE;
    }
  }
}
