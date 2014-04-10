<?php
/**
 * @file
 * Setup default input formats.
 */

namespace OmbuCore\Task;

class InputFormats extends Task {
  /**
   * Format settings.
   *
   * @param array
   */
  protected $formats;

  /**
   * Default format settings.
   */
  public function settings() {
    $this->formats = $this->loadSettings('formats');
  }

  /**
   * Save format settings.
   */
  public function process() {
    foreach ($this->formats as $format_name => $format) {
      $format = (object) $format;
      filter_format_save($format);
    }
  }
}
