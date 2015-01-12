<?php
/**
 * @file
 * Add site specific content.
 *
 * Creates node content structured as hierarchical menu
 */

namespace ombudemo_profile\Task;

class AddContent extends \ProfileTasks\Task\AddContent {
  protected $menu_nodes = array(
    'header-menu' => array(
      'Home' => array(
        '#link' => '<front>',
      ),
      'About' => array(
        '#file' => 'about.php',
        '#children' => array(
          'Our Story' => array(),
          'Our Team' => array(),
          'Our Values' => array(),
        ),
      ),
      'Contact' => array(),
    ),
  );

  /**
   * Implements parent::createHome().
   *
   * Add blocks to homepage.
   */
  protected function createHome() {
    $node = $this->loadNodeFromFile('homepage.php');

    // Disable XMLSitemap on frontpage.
    $node->xmlsitemap['status'] = 0;

    variable_set('site_frontpage', 'node/' . $node->nid);
  }

  /**
   * Implements parent::defaultMenuOptions().
   */
  protected function defaultMenuOptions($menu_link) {
    $options = parent::defaultMenuOptions($menu_link);
    $options['expanded'] = TRUE;
    return $options;
  }
}
