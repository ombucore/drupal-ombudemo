<?php
/**
 * @file
 * Setup site menus.
 */

namespace OmbuCore\Task;

class Menus extends Task {
  /**
   * New menus to create.
   *
   * Available keys that are required to create a new menu:
   *   - menu_name: The machine name of the new menu.
   *   - title: Display title
   *   - description: description of new menu.
   *
   * @var array
   */
  protected $menus = array();

  /**
   * Menu name of main menu.
   *
   * @var string
   */
  protected $main_menu;

  /**
   * Menu name of secondary menu.
   *
   * @var string
   */
  protected $secondary_menu;

  /**
   * Setup default menus.
   */
  public function settings() {
    $settings = $this->loadSettings('menu');

    // Add menus.
    $this->menus = $settings['menus'];

    // Set the main menu as the main menu.
    $this->main_menu = $settings['main_menu'];

    // Set the footer menu as the secondary menu.
    $this->secondary_menu = $settings['secondary_menu'];
  }

  /**
   * Add menus.
   */
  public function process() {
    foreach ($this->menus as $menu) {
      menu_save($menu);
    }

    // Update the menu router information.
    menu_rebuild();

    variable_set('menu_main_links_source', $this->main_menu);
    variable_set('menu_secondary_links_source', $this->secondary_menu);
  }
}
