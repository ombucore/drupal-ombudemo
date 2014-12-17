<?php

/**
 * @file
 * Definition of views_handler_filter_usage_in_use.
 */

/**
 * Filter by file usage.
 */
class views_handler_filter_usage_in_use extends views_handler_filter_boolean_operator {

  function get_value_options() {
    if (!isset($this->value_options)) {
      $this->value_value = t('File in use');
      $options = array(t('Yes'), t('No'));
      $this->value_options = $options;
    }
  }

  function query() {
    // Add a where clause based on the option chosen.
    $this->ensure_my_table();
    $field = "$this->table_alias.$this->real_field";

    $value = $this->value[0];
    if ($value == 0) {
      // In use.
      $this->query->add_where($this->options['group'], $field, 0, ">");
    }
    else {
      // Not in use.
      $this->query->add_where($this->options['group'], $field, NULL);
    }
  }
}
