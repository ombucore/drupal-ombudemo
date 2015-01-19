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
    // Create dummy wrapper to ease creation of beans.
    $wrapper = new Wrapper('node', array('type' => 'page'));

    $path = drupal_get_path('profile', 'ombudemo_profile') . '/assets/';
    $fid = $wrapper->addFile('team.jpg', $path);
    $fid = $fid['fid'];

    $bean = $wrapper->addBean('bean_rte_rte');
    $bean->value()->delta = 'contact-info';
    $bean->field_description = array(
      'value' => '<p>[[{"fid":"' . $fid . '","view_mode":"default","fields":{"format":"default","field_file_image_alt_text[und][0][value]":"","field_file_image_title_text[und][0][value]":""},"type":"media","link_text":null,"attributes":{"class":"media-element file-default"}}]]</p><h3>OMBU HQ</h3><p>107 SE Washington St #225</p><p>Portland, OR 97214</p><p>(503) 298-4888</p>',
      'format' => 'default',
    );
    $bean->save();
  }
}
