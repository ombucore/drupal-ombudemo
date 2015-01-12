<?php
/**
 * @file
 * Setup site blocks.
 */

namespace ombudemo_profile\Task;

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
    $bean = bean_create(array('type' => 'bean_rte_rte'));
    $bean->label = 'contact-info';
    $bean->delta = 'contact-info';
    $bean->setValues(array(
      'view_mode' => 'default',
    ));
    $bean->field_description = array(
      'und' =>
      array(
        0 =>
        array(
          'value' => '<h3>OMBU HQ</h3><p>107 SE Washington St #225</p><p>Portland, OR 97214</p><p>(503) 298-4888</p>',
          'format' => 'default',
        ),
      ),
    );
    bean_save($bean);
  }
}
