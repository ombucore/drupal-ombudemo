<?php
/**
 * @file
 * ombudemo_base.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function ombudemo_base_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'node-page-field_navigation_visible'.
  $field_instances['node-page-field_navigation_visible'] = array(
    'bundle' => 'page',
    'default_value' => array(
      0 => array(
        'value' => 0,
      ),
    ),
    'deleted' => 0,
    'description' => 'Show single scroll navigation for this content? If left unchecked, only the sections of this content will be visible, not section navigation.',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 5,
      ),
      'grid' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'title_block' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_navigation_visible',
    'label' => 'Show Navigation?',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(
        'display_label' => 1,
      ),
      'type' => 'options_onoff',
      'weight' => 36,
    ),
  );

  // Exported field_instance: 'node-page-field_sections'.
  $field_instances['node-page-field_sections'] = array(
    'bundle' => 'page',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'tiles_section',
        'settings' => array(),
        'type' => 'section_default',
        'weight' => 1,
      ),
      'grid' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'title_block' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_sections',
    'label' => 'Sections',
    'required' => 0,
    'settings' => array(
      'text_processing' => NULL,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => 37,
    ),
    'workbench_access_field' => 0,
  );

  // Exported field_instance: 'node-page-field_tags'.
  $field_instances['node-page-field_tags'] = array(
    'bundle' => 'page',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'inline',
        'module' => 'taxonomy',
        'settings' => array(),
        'type' => 'taxonomy_term_reference_plain',
        'weight' => 3,
      ),
      'grid' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'title_block' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_tags',
    'label' => 'Tags',
    'required' => 0,
    'settings' => array(
      'select2_integration' => array(
        'styling' => array(
          'dropdownAutoWidth' => 0,
          'placeholder' => '',
        ),
        'use_select2' => 0,
      ),
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'taxonomy',
      'settings' => array(
        'autocomplete_path' => 'taxonomy/autocomplete',
        'size' => 60,
      ),
      'type' => 'taxonomy_autocomplete',
      'weight' => 33,
    ),
  );

  // Exported field_instance: 'node-page-field_topics'.
  $field_instances['node-page-field_topics'] = array(
    'bundle' => 'page',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'inline',
        'module' => 'taxonomy',
        'settings' => array(),
        'type' => 'taxonomy_term_reference_plain',
        'weight' => 2,
      ),
      'grid' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'title_block' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_topics',
    'label' => 'Topic',
    'required' => 0,
    'settings' => array(
      'select2_integration' => array(
        'allow_add_onfly' => 0,
        'show_voc_terms_page_link' => 0,
        'styling' => array(
          'dropdownAutoWidth' => 0,
          'placeholder' => '',
        ),
        'use_select2' => 0,
      ),
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(
        'use_select2' => FALSE,
      ),
      'type' => 'options_select',
      'weight' => 32,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Sections');
  t('Show Navigation?');
  t('Show single scroll navigation for this content? If left unchecked, only the sections of this content will be visible, not section navigation.');
  t('Tags');
  t('Topic');

  return $field_instances;
}
