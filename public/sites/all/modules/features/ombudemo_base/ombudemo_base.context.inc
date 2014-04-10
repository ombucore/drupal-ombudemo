<?php
/**
 * @file
 * ombudemo_base.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function ombudemo_base_context_default_contexts() {
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
        'ombucleanup-site_logo' => array(
          'module' => 'ombucleanup',
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
        'ombucleanup-page_title' => array(
          'module' => 'ombucleanup',
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
