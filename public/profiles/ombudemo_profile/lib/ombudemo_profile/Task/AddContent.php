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
      'About' => array(),
      'Contact' => array(),
    ),
  );

  /**
   * Implements parent::createHome().
   *
   * Add blocks to homepage.
   */
  protected function createHome() {
    $node = $this->setupNode();

    // Disable XMLSitemap on frontpage.
    $node->xmlsitemap['status'] = 0;

    $node->title = 'Home';
    $node->tiles = array(
      'ombubeans-fpohero' => array(
        'module' => 'bean',
        'delta' => 'ombubeans-fpohero',
        'region' => 'content',
        'weight' => 0,
      ),
      'bean-bean-rte-rte-0' => array(
        'module' => 'bean',
        'delta' => 'bean-rte-rte-0',
        'region' => 'content',
        'weight' => 1,
        'width' => 4,
      ),
      'bean-bean-rte-rte-1' => array(
        'module' => 'bean',
        'delta' => 'bean-rte-rte-1',
        'region' => 'content',
        'weight' => 2,
        'width' => 4,
      ),
      'bean-bean-rte-rte-2' => array(
        'module' => 'bean',
        'delta' => 'bean-rte-rte-2',
        'region' => 'content',
        'weight' => 3,
        'width' => 4,
      ),
      'bean-bean-rte-rte-3' => array(
        'module' => 'bean',
        'delta' => 'bean-rte-rte-3',
        'region' => 'content',
        'weight' => 4,
        'width' => 4,
      ),
      'bean-bean-rte-rte-4' => array(
        'module' => 'bean',
        'delta' => 'bean-rte-rte-4',
        'region' => 'content',
        'weight' => 5,
        'width' => 4,
      ),
      'bean-bean-rte-rte-5' => array(
        'module' => 'bean',
        'delta' => 'bean-rte-rte-5',
        'region' => 'content',
        'weight' => 6,
        'width' => 4,
      ),
    );

    node_save($node);

    variable_set('site_frontpage', 'node/' . $node->nid);
  }
}
