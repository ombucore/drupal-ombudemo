<?php
// $Id$

/**
 * Setup site menus.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_menus($install_state) {
  // Create menus
  $menus = array(
    array(
      'menu_name' => 'footer-menu',
      'title' => st('Footer Menu'),
      'description' => st('The footer menu displays links in the footer of the site.'),
    ),
  );
  foreach ($menus as $menu) {
    menu_save($menu);
  }

  // Update the menu router information.
  menu_rebuild();

  variable_set('menu_main_links_source', 'main-menu');
  variable_set('menu_secondary_links_source', 'footer-menu');

  // Additional menus setup in add_content.php to account for the menu structure 
  // created by inserting nodes.
}
