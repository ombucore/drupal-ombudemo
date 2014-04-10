<?php
/**
 * @file
 * tiles_base.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function tiles_base_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_sections'
  $field_bases['field_sections'] = array(
    'active' => 1,
    'cardinality' => -1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_sections',
    'foreign keys' => array(),
    'indexes' => array(),
    'locked' => 0,
    'module' => 'tiles_section',
    'settings' => array(
      'max_length' => 255,
    ),
    'translatable' => 0,
    'type' => 'tiles_section',
  );

  return $field_bases;
}
