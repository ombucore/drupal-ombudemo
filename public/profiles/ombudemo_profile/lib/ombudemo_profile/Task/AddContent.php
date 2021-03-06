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
      'Bridges' => array(
        '#file' => 'bridges.php',
      ),
      'Contact' => array(
        '#link' => 'contact',
      ),
      'A demo of OMBU CMS' => array(
        '#link' => '<nolink>',
      ),
    ),
    'main-menu' => array(
      'Page 1' => array(),
      'Page 2' => array(),
      'Page 3' => array(),
      'Page 4' => array(),
    ),
    'footer-menu' => array(
      '© OMBU' => array(
        '#link' => 'http://ombuweb.com',
      ),
      'Terms of Use' => array(),
      'Privacy Policy' => array(),
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
