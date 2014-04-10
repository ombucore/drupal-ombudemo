<?php
/**
 * @file
 * Add site specific content.
 *
 * Creates node content structured as hierarchical menu
 */

namespace OmbuCore\Task;

use OmbuCore\Content\WrapperException;

class AddContent extends Task {
  /**
   * @param boolean
   *
   * If TRUE, a new blank homepage page node will be created.
   */
  protected $homepage_node;

  /**
   * @param array
   *
   * Structured array of nodes and/or links to be added to a menu.
   *
   * An example array looks like:
   *
   * @code
   *   $menu_nodes['main-menu'] = array(
   *     'About Us' => array(
   *       '#children' => array(
   *         'Our History' => array(),
   *         'Our Culture' => array(),
   *         'Our Team' => array(
   *           '#children' => array(
   *             'How We Work' => array(),
   *             'Our Departments' => array(
   *               '#link' => 'about-us/our-team/our-departments',
   *             ),
   *             'Work With Us' => array(),
   *           ),
   *         ),
   *       ),
   *     ),
   *   );
   * @endcode
   *
   * Some important notes about the structure of this array:
   *
   *   - The keys of the subarray become the node and/or menu title.
   *   - If a menu has children, the '#children' key can be used to contain an
   *     array of all children menu items.
   *   - If just a menu link should be created, instead of corresponding page
   *     node, add a '#link' key to the array definition for that menu item.
   */
  protected $menu_nodes;

  /**
   * Adds a simple way for adding a structure menu system.
   */
  public function settings() {
    $this->homepage_node = TRUE;
  }

  /**
   * Process creating structure content.
   */
  public function process() {
    if ($this->homepage_node) {
      $this->createHome();
    }

    if ($this->menu_nodes) {
      foreach ($this->menu_nodes as $menu => $nodes) {
        $this->buildMenu($menu, $nodes);
      }
    }
  }

  /**
   * Create homepage node and set it to the front page.
   */
  protected function createHome() {
    $node = $this->setupNode();
    $node->title = 'Home';
    $node->body[$node->language][0]['value'] = $this->lorem();
    $node->body[$node->language][0]['format'] = 'default';
    node_save($node);
    variable_set('site_frontpage', 'node/' . $node->nid);
  }

  /**
   * Build structured nodes into a menu system.
   */
  protected function buildMenu($menu_name, $nodes, $parent = NULL) {
    $weight = -50;

    foreach ($nodes as $title => $content) {
      // Check if a defined link exists
      if (isset($content['#link'])) {
        $menu_link = $this->defaultMenuOptions($content) + array(
          'weight' => $weight++,
          'menu_name' => $menu_name,
          'link_title' => $title,
          'link_path' => $content['#link'],
        );
        if ($parent) {
          $menu_link['plid'] = $parent['mlid'];
        }
        menu_link_save($menu_link);
      }
      // Otherwise treat as a regular node with possible children.
      else {
        // Allow nodes to be loaded from file.
        if (isset($content['#file'])) {
          $node = $this->loadNodeFromFile($content['#file']);
        }
        else {
          // Allow node type to be set.
          $type = isset($content['#type']) ? $content['#type'] : 'page';

          // Create a new node.
          $node = $this->setupMenuNode($title, $type, $content);
        }

        // Make sure a menu item is created for this node.
        $node->menu = $this->defaultMenuOptions($content) + array(
          'weight' => $weight++,
          'menu_name' => $menu_name,
          'link_title' => isset($content['#link_title']) ? $content['#link_title'] : $node->title,
        );

        if ($parent) {
          $node->menu['plid'] = $parent['mlid'];
        }

        // Prevent the menu from being rebuilt every time a new node is saved.
        // Not sure who is requesting the menu rebuild (it doesn't need it), so
        // always try and disable the rebuild during each node save.
        variable_set('menu_rebuild_needed', FALSE);
        node_save($node);

        $menu_link = $node->menu;
      }

      // If there's children, build them too.
      if (!empty($content['#children'])) {
        $this->buildMenu($menu_name, $content['#children'], $menu_link);
      }
    }
  }

  /**
   * Setup node for placement within a menu.
   *
   * @param string $title
   *   The title for the new node.
   * @param string $type
   *   The type of node to create.
   * @param array $content
   *   Any additional settings defined in $menu_nodes.
   *
   * @return object
   *   A new prepared node object.
   */
  protected function setupMenuNode($title, $type = 'page', $content = array()) {
    $node = $this->setupNode($type);
    $node->title = $title;

    // Add lorem text to body.
    $node->body[$node->language][0]['value'] = $this->lorem();
    $node->body[$node->language][0]['format'] = 'default';

    if (module_exists('ombubench')) {
      $term = taxonomy_get_term_by_name('Administrators only');
      $term = current($term);
      if ($term) {
        $node->field_access_section[LANGUAGE_NONE][0]['tid'] = $term->tid;
      }

      $node->workbench_moderation_state_new = 'published';
    }

    return $node;
  }


  /**
   * Setup default menu link options.
   *
   * Allows subclasses to setup alternate or additional options, such as
   * 'expanded'.
   *
   * @param array $menu_link
   *   Menu link definition as defined in $menu_nodes.
   *
   * @return array
   *   Array of menu link options as expected by menu_link_save().
   */
  protected function defaultMenuOptions($menu_link) {
    return array(
      'enabled' => TRUE,
    );
  }

  /**
   * Load up node from include file.
   *
   * @param string $name
   *   The name of the file to include.
   *
   * @return stdClass
   *   The created node object.
   */
  protected function loadNodeFromFile($name) {
    $path = drupal_get_path('profile', $this->profile) . "/initial-content/" . $name;

    // Throw error if file isn't found.
    if (!file_exists($path)) {
      throw new TaskException('Unable to find content file: ' . $path);
    }

    try {
      // Include content file. It should create a new \OmbuCore\Content\Wrapper
      // object.
      include $path;

      // Try to find any variables defined of type Wrapper in order to return
      // proper node to add to menu.
      $vars = get_defined_vars();
      foreach ($vars as $var) {
        if ($var instanceof \OmbuCore\Content\Wrapper) {
          $wrapper = $var;
          break;
        }
      }

      // Throw error if wrapper not found.
      if (!$wrapper) {
        throw new TaskException('Content file ' . $name . ' malformed, must create Wrapper object');
      }

      $node = $wrapper->value();

      // In order to properly set the tokens for the node in the menu, the token
      // menu cache for this node needs to be rebuilt.
      // @see token_node_menu_link_load().
      $cache =& drupal_static('token_node_menu_link_load', array());
      if (isset($cache[$node->nid])) {
        unset($cache[$node->nid]);
      }

      return $wrapper->value();
    }
    catch (WrapperException $e) {
      throw new TaskException('Exception in content file ' . $name . ': ' . $e->getMessage());
    }
  }
}
