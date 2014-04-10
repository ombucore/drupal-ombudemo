<?php

/**
 * @file
 * Pre setup tasks.
 *
 * Any tasks that require all other settings and content to be defined.
 */

namespace OmbuCore\Task;

class PreSetup extends Task {
  /**
   * Implements parent::process().
   */
  public function process() {
    // Set default permissions for new directories and files.
    // Note that these are decimal representations of octal numbers:
    // 1528 = 02770
    // 432  = 0660
    variable_set('file_chmod_directory', 1528);
    variable_set('file_chmod_file', 432);
  }
}
