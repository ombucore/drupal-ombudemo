<?php

// Main theme for site.
define('OMBUBASE_DEFAULT_THEME', 'tiles');

/**
 * Implements hook_install_tasks().
 */
function ombuprofile_install_tasks() {
  return array(
    'setup_themes' => array(
      'display_name' => st('Setup Themes'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_content_types' => array(
      'display_name' => st('Setup Content Types'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_vars' => array(
      'display_name' => st('Setup Site Variables'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_taxonomy' => array(
      'display_name' => st('Setup Taxonomy'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_menus' => array(
      'display_name' => st('Setup Menus'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_blocks' => array(
      'display_name' => st('Setup Blocks'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_input_formats' => array(
      'display_name' => st('Setup Input Formats'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'setup_users' => array(
      'display_name' => st('Setup Roles & Users'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'add_files' => array(
      'display_name' => st('Add Files'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'add_content' => array(
      'display_name' => st('Add Content'),
      'function' => 'ombuprofile_install_task_router',
    ),
    'post_setup' => array(
      'display_name' => st('Post Setup'),
      'function' => 'ombuprofile_install_task_router',
    ),
    /*
      'setup_xmlsitemap' => array(
      'display_name' => st('Setup XML Sitemap'),
      'function' => 'ombuprofile_install_task_router',
      ),
     */
  );
}

/**
 * Routes install task to appropriate file and/or function.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_install_task_router($install_state) {
  $path = drupal_get_path('module', 'ombuprofile');

  $task = $install_state['active_task'];
  $task_function = 'ombuprofile_' . $task;

  if (!function_exists($task_function) && file_exists($path . '/tasks/' . $task . '.php')) {
    require($path . '/tasks/' . $task . '.php');
  }

  if (function_exists($task_function)) {
    return call_user_func($task_function, $install_state);
  } else {
    return st('Something went wront with task @task and function @function', array('@task' => $task, '@function' => $task_function));
  }
}

/**
 * Implements hook_menu().
 */
function ombuprofile_menu() {
  $items = array();

  $items['ombuprofile_404'] = array(
    'title' => t('Page not found'),
    'access callback' => TRUE,
    'page callback' => 'ombuprofile_404_page',
    'type' => MENU_CALLBACK,
  );

  return $items;
}

/**
 * Implementation of hook_image_default_styles().
 */
function ombuprofile_image_default_styles() {
  $styles = array();

  /*
  $styles['ombu_thumbnail'] = array(
    'effects' => array(
      array(
        'name' => 'image_scale',
        'data' => array('width' => 141, 'height' => 116, 'upscale' => 0),
        'weight' => 0,
      ),
    )
  );
  */

  return $styles;
}

/**
 * Implements hook_block_info().
 */
function ombuprofile_block_info() {
  // Define site specific blocks here.
  $blocks = array();
  return $blocks;
}

/**
 * Implements hook_block_view().
 */
function ombuprofile_block_view($delta = '') {
  $block = array();
  return $block;
}

/**
 * 404 page callback.
 */
function ombuprofile_404_page() {
  drupal_set_title(t('Page not found'));
  return t('The requested page could not be found.');
}

/**
 * Implements hook_ctools_plugin_api().
 */
function ombuprofile_ctools_plugin_api($module, $api) {
  if ($module == 'context' && $api == 'plugins') {
    return array('version' => 3);
  }
}

/**
 * Implements hook_context_plugins().
 */
function ombuprofile_context_plugins() {
  $plugins = array();
  $plugins['context_condition_frontend'] = array(
    'handler' => array(
      'path' => drupal_get_path('module', 'ombuprofile') . '/plugins',
      'file' => 'context_condition_frontend.inc',
      'class' => 'context_condition_frontend',
      'parent' => 'context_condition',
    ),
  );
  return $plugins;
}

/**
 * Implements of hook_context_registry().
 */
function ombuprofile_context_registry() {
  $registry = array();

  $registry['conditions'] = array(
    'frontend' => array(
      'title' => t('Front End Theme'),
      'description' => 'This condition triggers on pages themed with theme_default.',
      'plugin' => 'context_condition_frontend',
    ),
  );
  return $registry;
}

/**
 * Implements of hook_context_page_reaction()
 */
function ombuprofile_context_page_condition() {
  global $theme;
  if ($plugin = context_get_plugin('condition', 'frontend')) {
    $plugin->execute($theme);
  }
}

