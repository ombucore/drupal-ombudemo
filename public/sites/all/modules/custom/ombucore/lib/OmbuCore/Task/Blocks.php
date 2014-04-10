<?php
/**
 * @file
 * Setup site blocks.
 */

namespace OmbuCore\Task;

class Blocks extends Task {
  /**
   * @param array
   * Blocks for the default theme
   */
  protected $default_blocks;

  /**
   * @param array
   * Blocks for the admin theme
   */
  protected $admin_blocks;

  /**
   * Assign some default blocks.
   */
  public function settings() {
    $settings = $this->loadSettings('blocks');
    $this->default_blocks = $settings['default_blocks'];
    $this->admin_blocks = $settings['admin_blocks'];
  }

  /**
   * Insert/update block locations.
   */
  public function process() {
    $theme_blocks = array(
      variable_get('theme_default', '') => $this->default_blocks,
      variable_get('admin_theme', 'seven') => $this->admin_blocks,
    );

    foreach ($theme_blocks as $theme => $blocks) {
      _block_rehash($theme);
      foreach ($blocks as $record) {
        // Set some sane defaults.
        $record += array(
          'status' => 1,
          'weight' => 0,
          'pages' => '',
          'cache' => -1,
        );

        $query = db_merge('block')
          ->key(array(
            'theme' => $theme,
            'module' => $record['module'],
            'delta' => $record['delta'],
          ));

        unset($record['module'], $record['delta']);
        $query->fields($record);

        $query->execute();
      }
    }
  }
}
