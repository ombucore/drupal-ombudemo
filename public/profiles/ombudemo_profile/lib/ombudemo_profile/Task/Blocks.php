<?php
/**
 * @file
 * Setup site blocks.
 */

namespace ombudemo_profile\Task;

use ProfileTasks\Content\Wrapper;

class Blocks extends \ProfileTasks\Task\Blocks {
  /**
   * Insert/update block locations.
   */
  public function process() {
    parent::process();

    $this->addBeans();
  }

  /**
   * Add additional beans for dynamic pages.
   *
   * Beans are usually added via the Wrapper object in intial-content files,
   * but these beans are added to dynamic pages (e.g. Contact), so they need to
   * be created first.
   */
  protected function addBeans() {
    $bean = bean_create(array('type' => 'sociallinks'));
    $bean->label = 'footer-social';
    $bean->title = 'Follow us';
    $bean->delta = 'footer-social';
    $bean->setValues(array(
      'view_mode' => 'default',
    ));
    $bean->field_sociallinks_sociallinks[LANGUAGE_NONE] = array(
      array(
        'service' => 'instagram',
        'url' => 'http://instagram.com',
      ),
      array(
        'service' => 'twitter',
        'url' => 'https:twitter.com',
      ),
      array(
        'service' => 'facebook',
        'url' => 'https://www.facebook.com',
      ),
      array(
        'service' => 'youtube',
        'url' => 'https://www.youtube.com',
      ),
    );
    bean_save($bean);

    $bean = bean_create(array('type' => 'bean_link'));
    $bean->delta = 'footer-links';
    $bean->field_bean_links_links[LANGUAGE_NONE][] = array(
      'title' => 'Home',
      'url' => '<front>',
    );
    $bean->field_bean_links_links[LANGUAGE_NONE][] = array(
      'title' => 'About',
      'url' => 'about',
    );
    $bean->field_bean_links_links[LANGUAGE_NONE][] = array(
      'title' => 'Bridges',
      'url' => 'bridges',
    );
    $bean->field_bean_links_links[LANGUAGE_NONE][] = array(
      'title' => 'Contact',
      'url' => 'contact',
    );
    $bean->field_bean_links_links[LANGUAGE_NONE][] = array(
      'title' => 'Search',
      'Url' => 'search',
    );
    $bean->save();
  }
}
