<?php

/**
 * @file
 * Setup site blocks.
 */

namespace ombuprofile\Task;

class Blocks extends \OmbuCore\Task\Blocks {
  /**
   * Implements parent::process().
   *
   * Adds additional beans for homepage.
   */
  public function process() {
    parent::process();

    $bean = bean_create(array('type' => 'ombubeans_fpohero'));
    $bean->label = 'ombubeans_fpohero';
    $bean->title = '';
    $bean->delta = 'ombubeans-fpohero';
    $bean->setValues(array(
      'view_mode' => 'default',
      'body' => '<h1>Hello, world!</h1>
      <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
      <p><a class="btn btn-primary btn-large">Learn more »</a></p>
      ',
      'width' => '12',
    ));
    bean_save($bean);

    for ($i = 0; $i < 6; $i++) {
      $bean = bean_create(array('type' => 'bean_rte_rte'));
      $bean->label = 'bean_rte_rte-' . $i;
      $bean->title = 'Text Block ' . (string) ($i + 1);
      $bean->delta = 'bean-rte-rte-' . $i;
      $bean->setValues(array(
        'view_mode' => 'default',
        'width' => 3,
      ));
      $bean->field_description = array(
        'und' =>
        array(
          0 =>
          array(
            'value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p><p><a class="btn" href="#">View details »</a></p>',
            'format' => 'default',
          ),
        ),
      );
      bean_save($bean);
    }

    bean_reset();
    drupal_static_reset('bean_get_all_beans');
    $theme = variable_get('theme_default', '');
    _block_rehash($theme);
  }
}
