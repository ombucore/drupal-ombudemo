<?php

/**
 * @file
 * Home page example content.
 */

use ProfileTasks\Content\Wrapper;

$wrapper = new Wrapper('node', array('type' => 'page'));
$wrapper->title = 'Home';

$path = drupal_get_path('profile', 'ombudemo_profile') . '/assets/';

$bean = $wrapper->addBean('ombugallery', 'content');
$bean->value()->bean_style = 'bootstrap_slideshow';
ombugallery_create_slide($bean->value(), $path . 'botticelli.jpg', 'Nascita di Venere', 'Sandro Boticelli');
ombugallery_create_slide($bean->value(), $path . 'seurat.jpg', 'Sunday Afternoon on the Island of La Grande Jatte', 'Georges Seurat');

$bean = $wrapper->addBean('bean_rte_rte', 'content', 6);
$bean->title = 'Text Block 1';
$bean->field_description = array(
  'value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p><p><a class="btn" href="#">View details »</a></p>',
  'format' => 'default',
);

$bean = $wrapper->addBean('bean_rte_rte', 'content', 6);
$bean->title = 'Text Block 2';
$bean->field_description = array(
  'value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p><p><a class="btn" href="#">View details »</a></p>',
  'format' => 'default',
);

$bean = $wrapper->addBean('bean_rte_rte', 'content', 4);
$bean->title = 'Text Block 3';
$bean->field_description = array(
  'value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p><p><a class="btn" href="#">View details »</a></p>',
  'format' => 'default',
);

$bean = $wrapper->addBean('bean_rte_rte', 'content', 4);
$bean->title = 'Text Block 4';
$bean->field_description = array(
  'value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p><p><a class="btn" href="#">View details »</a></p>',
  'format' => 'default',
);

$bean = $wrapper->addBean('bean_rte_rte', 'content', 4);
$bean->title = 'Text Block 5';
$bean->field_description = array(
  'value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p><p><a class="btn" href="#">View details »</a></p>',
  'format' => 'default',
);

$wrapper->save();
