<?php
/**
 * @file
 * base.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function base_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "context" && $api == "context") {
    return array("version" => "3");
  }
}
