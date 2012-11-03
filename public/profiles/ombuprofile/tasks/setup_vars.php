<?php
// $Id$

/**
 * Setup site variables.
 *
 * @todo still need to migrate other vars functions.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_vars($install_state) {
  // @todo: Import vars from below
  //variable_set('site_slogan', 'Advancing Diagnostics to Improve Public Health');
  variable_set('menu_secondary_links_source', 'header-links');

  // Locale settings
  variable_set('site_default_country', 'US');
  variable_set('date_first_day', 1);

  // 404 settings
  variable_set('site_404', 'ombuprofile_404');

  // Date & Time settings
  variable_set('date_default_timezone_name', 'America/New_York');
  variable_set('configurable_timezones', 0);

  // Views basic UI settings
  variable_set('views_basic_ui', array(
    'departments' => array(
      'page_1',
    ),
    'articles' => array(
      'page_1',
    ),
  ));
  variable_set('views_basic_ui_fields', array(
    'header' => 'header',
    'title' => 'title',
  ));

  // OmbuSEO settings
  variable_set('ombuseo_node_page', 1);

  _profile_setup_vars_pathauto();

  // oEmbed / media settings.
  $variables['default_oembedcore_provider'] = array(
    'youtube' => FALSE,
    'vimeo' => FALSE,
    'flickr' => FALSE,
    'qik' => FALSE,
    'revision3' => FALSE,
    'twitter' => FALSE,
  );

  foreach ($variables as $k => $v) {
    variable_set($k, $v);
  }

  variable_set('jquery_update_jquery_version', '1.8');
}

function _profile_setup_vars() {

  _profile_setup_vars_ombumailer();
  _profile_setup_vars_pathauto();
  _profile_setup_vars_error_reporting();
  _profile_setup_vars_performance();

  variable_set('date_default_timezone_name', 'America/Los_Angeles');

  // No hover links on views
  variable_set('views_no_hover_links', 1);

  // Enabe access logs
  variable_set('statistics_enable_access_log', TRUE);

  // Captcha settings
  db_query('DELETE FROM {captcha_points}');
  db_query("INSERT INTO {captcha_points} (form_id, module, type) VALUES ('form_id', 'captcha_module', 'captcha_type')");
  variable_set('captcha_add_captcha_description', FALSE);
  variable_set('captcha_persistence', 0);

  // File Sizes
  variable_set('upload_uploadsize_default', 20);
  variable_set('upload_usersize_default', 10000);
}

// Ombumailer (admin/siteconfig, test at admin/settings/ombumailer)
function _profile_setup_vars_ombumailer() {

  $ombumailer_settings = array(
    'username' => 'ac40599',
    'password' => '7rzomKKHNYik7rgS',
    'host' => 'mail.authsmtp.com',
    'port' => '2525',
    'use_authentication' => 1,
    'globalfromaddress' => 0,
    'debug' => 0,
    'log' => 1,
  );

  variable_set('ombumailer_settings', $ombumailer_settings);
}

// Pathauto (admin/build/path/pathauto)
function _profile_setup_vars_pathauto() {

  //variable_set('ombu_menupath_priority_menu', 'menu-site-nav');

  /**
   * Update Action
   *  0 - Do nothing. Leave the old alias intact.
   *  1 - Create a new alias. Leave the existing alias functioning.
   *  2 - Create a new alias. Delete the old alias.
   */
  variable_set('pathauto_update_action', '2');

  /**
   * Reduce strings to letters and numbers from ASCII-96
   */
  variable_set('pathauto_reduce_ascii', TRUE);

  variable_set('pathauto_node_applytofeeds', '');


  /**
   * Default node pattern
   */
  variable_set('pathauto_node_pattern', 'content/[node:title]');
}

// Error Reporting (admin/settings/error-reporting)
function _profile_setup_vars_error_reporting() {

  /**
   * Error reporting:
   *  0 - Write errors to the log
   *  1 - Write errors to the log and to the screen
   */
  variable_set('error_level', "0");

}

// Performance (admin/settings/performance)
function _profile_setup_vars_performance() {

  /**
   * Only setup caching if the environment isn't development
   */
  if (ombu_env('development')) {
    return;
  }

  /**
   * Caching mode:
   *  0 - Disabled
   *  1 - Normal
   *  2 - Aggressive
   */
  variable_set('cache', "1");

  /**
   * Minimum cache lifetime (seconds):
   *  0 - Disabled
   *  1 - Normal
   *  2 - Aggressive
   */
  variable_set('cache_lifetime', "60");

  /**
   * Page Compression (enabled/disabled)
   */
  variable_set('page_compression', '1');

  /**
   * Block Cache (enabled/disabled)
   */
  variable_set('block_cache', "1");

  /**
   * Aggregate CSS (enabled/disabled)
   */
  variable_set('preprocess_css', "1");

  /**
   * Aggregate JS (enabled/disabled)
   */
  variable_set('preprocess_js', "1");
}
