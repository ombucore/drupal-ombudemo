<?php
/**
 * @file
 * Setup WYSIWYG setting.
 */

namespace OmbuCore\Task;

class Wysiwyg extends Task {
  /**
   * Wysiwyg settings.
   *
   * @param array
   */
  protected $wysiwyg;

  /**
   * Default wysiwyg settings.
   */
  public function settings() {
    $this->wysiwyg = $this->loadSettings('wysiwyg');
  }

  /**
   * Save wysiwyg settings.
   */
  public function process() {
    foreach ($this->wysiwyg as $wysiwyg_name => $object) {
      db_insert('wysiwyg')
        ->fields(array(
          'format' => $object['format'],
          'editor' => $object['editor'],
          'settings' => serialize($object['settings']),
        ))
        ->execute();
    }
  }
}
