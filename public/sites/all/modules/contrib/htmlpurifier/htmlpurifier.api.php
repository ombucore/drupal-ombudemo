<?php

/**
 * @file
 * API documentation for the HTML Purifier module.
 */

/**
 * Allows modules to alter the HTML Definition used by HTML Purifier.
 *
 * @param HTMLPurifier_HTMLDefinition $html_definition
 *   The HTMLPurifier definition object to alter.
 */
function hook_htmlpurifier_html_definition_alter($html_definition) {
  // Allow to use the 'data-type' attribute on images.
  $html_definition->addAttribute('img', 'data-type', 'Text');
}
