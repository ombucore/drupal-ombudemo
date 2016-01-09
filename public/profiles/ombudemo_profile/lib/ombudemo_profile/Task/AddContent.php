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
      'About' => array(
        '#file' => 'about.php',
      ),
      'Bridges' => array(),
      'Contact' => array(
        '#link' => 'contact',
      ),
    ),
    'footer-menu' => array(
      ' © OMBU' => array(),
      'Terms of Use' => array(),
      'Privacy' => array(),
    ),
  );

  /**
   * Implements parent::process().
   */
  public function process() {
    parent::process();

    $this->loadNodeFromFile('dummy-pages.php');
    $this->addContactBlocks();
  }

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

  /**
   * Adds blocks to contact page.
   */
  protected function addContactBlocks() {
    $layout = tiles_get_container('region')->getLayout('contact');

    $layout->addBlock(array(
      'module' => 'bean',
      'delta' => 'contact-info',
      'region' => 'content',
      'weight' => 1,
      'width' => 6,
    ));

    $layout->addBlock(array(
      'module' => 'system',
      'delta' => 'main',
      'region' => 'content',
      'weight' => 2,
      'width' => 6,
    ));

    $layout->save();
  }
}
