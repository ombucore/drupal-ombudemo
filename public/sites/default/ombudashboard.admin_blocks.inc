<?php

/**
*  @file ombudashboard_blocks.inc.example
*
*   This file is provided as an example and starting point
*   for the site dashboard blocks. You can copy this file into
*   your current front-end active theme and name it ombudashboard_blocks.inc
*/

/**
 * Returns dashboard page blocks
 */
function _ombudashboard_get_admin_blocks() {

  $blocks[] = array(
    'title' => 'Core Content',
    'content' => _ombudashboard_content_block(),
    'position' => 'left',
    'theme' => 'ombu_admin_block_content_manage',
  );

  if ( user_access('administer taxonomy') ) {
    $blocks[] = array(
      'title' => 'Categories',
      'content' => _ombudashboard_get_admin_categories_block(),
      'position' => 'left',
      'theme' => 'ombu_admin_block_content',
    );
  }

  if ( user_access('administer menu') ) {
    $blocks[] = array(
      'title' => 'Navigation',
      'content' => _ombudashboard_get_admin_nav_block(),
      'position' => 'right',
      'theme' => 'ombu_admin_block_content',
    );
  }

  $blocks[] = array(
    'title' => 'Users &amp; Settings',
    'content' => _ombudashboard_get_admin_block3(),
    'position' => 'right',
    'theme' => 'ombu_admin_block_content',
  );

  if ( user_access('access site reports') ) {
    $blocks[] = array(
      'title' => 'Reports',
      'description' => 'View site reports including Web Analytics',
      'content' => _ombudashboard_get_admin_block2(),
      'position' => 'right',
      'theme' => 'ombu_admin_block_content',
    );
  }

  return $blocks;
}

/**
 * Returns an array with the themed contents for a dashboard block
 */
function _ombudashboard_content_block() {
  $content = array();

  $types = array(
    '' => 'All Content',
    'page' => 'Pages',
  );
  foreach ($types as $type => $name) {
    if ($type && (user_access('administer nodes') ||  user_access("create $type content"))) {
      $pages = array(
        'title' => $name,
        'operations' => array(
          array(
            'title' => 'Add',
            'href' => 'node/add/' . str_replace('_', '-', $type),
            'localized_options' => array(),
          ),
        ),
      );
      if (!$type || user_access('administer nodes') || user_access("delete any $type content") ) {
        $pages['operations'][] = array(
          'title' => 'Manage',
          'href' => 'admin/dashboard/manage-content',
          'localized_options' => array(
            'query' => array(
              'type' => $type,
            ),
          ),
        );
      }

      $content[] = $pages;
    }
  }

  if (user_access('administer files')) {
    $content[] = array(
      'title' => 'Media',
      'operations' => array(
        array(
          'title' => 'Add',
          'href' => 'admin/dashboard/manage-media/add',
          'localized_options' => array(),
        ),
        array(
          'title' => 'Manage',
          'href' => 'admin/dashboard/manage-media',
          'localized_options' => array(),
        ),
      ),
    );
  }

  return $content;
}

/**
 * Returns an array with the themed contents for a dashboard block
 */
function _ombudashboard_get_admin_block2() {
  $content = array(
    array(
      'title' => 'Most Popular Pages',
      'href' => 'admin/reports/pages',
      'localized_options' => array(),

    ),
    array(
      'title' => 'Top Referrers',
      'href' => 'admin/reports/referrers',
      'description' => 'See where site visitors are coming from',
      'localized_options' => array(),

    ),
    array(
      'title' => 'Broken Links Report',
      'href' => 'admin/reports/page-not-found',
      'description' => 'View \'page not found\' errors (404s)',
      'localized_options' => array(),
    ),
  );

  return $content;
}

/**
 * Returns an array with the themed contents for a dashboard block
 */
function _ombudashboard_get_admin_block3() {
  global $user;

  $content = array();

  $content[] = array(
    'title' => 'Manage Your Account',
    'href' => 'user/'. $user->uid .'/edit',
    'description' => 'Edit your account information',
    'localized_options' => array(),
  );
  if ( user_access('administer users') ) {
    $content[] = array(
      'title' => 'Manage Users',
      'href' => 'admin/dashboard/manage-users',
      'description' => 'Add, remove, and manage site users',
      'localized_options' => array(),
    );
    $content[] = array(
      'title' => 'Create User',
      'href' => 'admin/people/create',
      'description' => 'Add a site user',
      'localized_options' => array(),
    );
  }

  if ( user_access('configure ombu site') ) {
    $content[] = array(
      'title' => 'Site Configuration',
      'href' => 'admin/siteconfig',
      'description' => 'Edit site properties',
      'localized_options' => array(),
    );
  }

  if ( user_access('administer redirects') ) {
    $content[] = array(
      'title' => 'Redirects',
      'href' => 'admin/config/search/redirect',
      'description' => 'Edit page redirects',
      'localized_options' => array(),
    );
  }

  if ( user_access('administer site configuration') ) {
    $content[] = array(
      'title' => 'Clear Caches',
      'href' => 'admin/dashboard/clear-caches',
      'description' => 'Clear site caches',
      'localized_options' => array(),
    );
  }

  return $content;
}

/**
 * Returns an array with the themed contents for a dashboard block
 */
function _ombudashboard_get_admin_nav_block() {
  $content = array();

  $content[] = array(
    'title' => 'Manage the Site\'s Navigation Menu',
    'href' => 'admin/structure/menu/manage/main-menu',
    'description' => 'Edit, enable and disable items from the site\'s menu',
    'localized_options' => array(),
  );

  $content[] = array(
    'title' => 'Manage the Header Menu',
    'href' => 'admin/structure/menu/manage/header-menu',
    'description' => 'Edit, enable and disable items from the site\'s header menu',
    'localized_options' => array(),
  );

  $content[] = array(
    'title' => 'Manage the Footer Menu',
    'href' => 'admin/structure/menu/manage/footer-menu',
    'description' => 'Edit, enable and disable items from the site\'s fotoer menu',
    'localized_options' => array(),
  );

  return $content;
}

/**
 * Returns an array with the themed contents for a dashboard block
 */
function _ombudashboard_get_admin_categories_block() {
  $content = array();

  $vocabs = taxonomy_vocabulary_get_names();
  foreach ($vocabs as $vocab) {
    if (user_access('edit terms in ' . $vocab->vid)) {
      $content[]  = array(
        'title' => $vocab->name,
        'href' => 'admin/structure/taxonomy/' . $vocab->machine_name,
        'description' => 'Manage ' . strtolower($vocab->name),
        'localized_options' => array(
          'query' => drupal_get_destination(),
        ),
      );
    }
  }

  return $content;
}

/**
 * Returns an array with the themed contents for a dashboard block
 */
function _ombudashboard_get_supplementary_content_block() {
  $content = array();

  module_load_include('php', 'ombudashboard', 'supplementary_content.inc');
  foreach(ombudashboard_get_supplementary_content_list() as $i => $obj) {
    $content[] = $obj;
  }

  if (user_access('administer files')) {
    $content[] = array(
      'title' => 'Files',
      'href' => 'admin/dashboard/manage-files',
      'localized_options' => array(),
      'description' => 'Edit and delete media files',
    );
  }

  return $content;
}
