<?php

/**
 * Context condition that triggers on pages with the passed theme
 * with path not starting with 'user'
 */
class context_condition_frontend extends context_condition {
  function condition_values() {
    return array(1 => t('Always active'));
  }

  function execute($theme) {
    foreach ($this->get_contexts() as $context) {
      if ($theme == variable_get('theme_default', NULL) &&
        strpos(drupal_get_path_alias(), "user") !== 0) {
          $this->condition_met($context, $theme);
        }
    }
  }
}

