<?php

/**
 * @file
 * Base Profile.
 */



/**
 * Implements hook_block_info().
 */
function ombuprofile_block_info() {
  // Define site specific blocks here.
  $blocks = array();
  $blocks['site_logo'] = array(
    'info' => t('Site Logo'),
    'cache' => DRUPAL_CACHE_GLOBAL,
  );
  $blocks['page_title'] = array(
    'info' => t('Page Title'),
    'cache' => DRUPAL_CACHE_PER_PAGE,
  );
  $blocks['breadcrumb'] = array(
    'info' => t('Breadcrumb'),
    'cache' => DRUPAL_CACHE_PER_PAGE,
  );
  return $blocks;
}

/**
 * Implements hook_block_view().
 */
function ombuprofile_block_view($delta = '') {
  $block = array();
  switch ($delta) {
    case 'site_logo':
      $block['subject'] = '';
      $block['content'] = array(
        'foo' => array(
          '#markup' => variable_get('site_name', 'Site Name'),
          '#prefix' => '<a href="/" class="brand">',
          '#suffix' => '</a>',
        ),
      );
      break;

    case 'page_title':
      $block['subject'] = '';
      $block['content'] = '';
      // Hide the title on the front page.
      // @todo: make this a setting, or at least more configurable.
      if (!drupal_is_front_page()) {
        $block['content'] = array(
          'title' => array(
            '#markup' => drupal_get_title(),
            '#prefix' => '<h1>',
            '#suffix' => '</h1>',
          ),
        );
      }
      break;

    case 'breadcrumb':
      $block['subject'] = '';
      $block['content'] = '';
      if ($breadcrumb = drupal_get_breadcrumb()) {
        $block['content'] = array(
          'breadcrumb' => array(
            '#markup' => theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb())),
          ),
        );
      }
      break;
  }
  return $block;
}
