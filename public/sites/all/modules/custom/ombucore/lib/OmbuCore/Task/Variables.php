<?php
/**
 * @file
 * Setup variables for site install.
 */

namespace OmbuCore\Task;

class Variables extends Task {
  /**
   * @var array
   * Variables array
   */
  protected $variables;

  /**
   * Setup variables.
   */
  public function settings() {
    $this->variables = $this->loadSettings('variables');
  }

  /**
   * Save all the variables.
   */
  public function process() {
    foreach ($this->variables as $key => $value) {
      variable_set($key, $value);
    }
  }
}
