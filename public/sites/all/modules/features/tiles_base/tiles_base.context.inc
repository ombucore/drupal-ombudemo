<?php
/**
 * @file
 * tiles_base.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function tiles_base_context_default_contexts() {
  $export = array();

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'global';
  $context->description = 'Global blocks';
  $context->tag = '';
  $context->conditions = array(
    'frontend' => array(
      'values' => array(
        1 => 1,
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'ombucore-site_logo' => array(
          'module' => 'ombucore',
          'delta' => 'site_logo',
          'region' => 'header',
          'weight' => '-11',
        ),
        'menu-header-menu' => array(
          'module' => 'menu',
          'delta' => 'header-menu',
          'region' => 'header',
          'weight' => '-10',
        ),
        'ombucore-page_title' => array(
          'module' => 'ombucore',
          'delta' => 'content_top',
          'region' => 'content',
          'weight' => '15',
        ),
        'ombucore-page_title' => array(
          'module' => 'ombucore',
          'delta' => 'page_title',
          'region' => 'content',
          'weight' => '-10',
        ),
        'system-main-menu' => array(
          'module' => 'system',
          'delta' => 'main-menu',
          'region' => 'sidebar_first',
          'weight' => '-10',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;

  // Translatables
  // Included for use with string extractors like potx.
  t('Global blocks');
  $export['global'] = $context;

  return $export;
}
