<?php
/**
 * @file
 * ombudemo_profile_base.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function ombudemo_profile_base_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "context" && $api == "context") {
    return array("version" => "3");
  }
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}
