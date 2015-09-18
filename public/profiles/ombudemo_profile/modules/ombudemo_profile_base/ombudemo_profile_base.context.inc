<?php
/**
 * @file
 * ombudemo_profile_base.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function ombudemo_profile_base_context_default_contexts() {
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
          'weight' => -11,
        ),
        'ombucleanup-breadcrumb' => array(
          'module' => 'ombucleanup',
          'delta' => 'breadcrumb',
          'region' => 'content_top',
          'weight' => -1,
        ),
        'ombucleanup-page_title' => array(
          'module' => 'ombucleanup',
          'delta' => 'page_title',
          'region' => 'content',
          'weight' => -10,
        ),
        'menu-footer-menu' => array(
          'module' => 'menu',
          'delta' => 'footer-menu',
          'region' => 'footer',
          'weight' => -1,
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
