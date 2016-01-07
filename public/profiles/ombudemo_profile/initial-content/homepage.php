<?php

/**
 * @file
 * Home page example content.
 */

use ProfileTasks\Content\Wrapper;

$wrapper = new Wrapper('node', array('type' => 'page'));
$wrapper->title = 'Stumptown Bridges';

$path = drupal_get_path('profile', 'ombudemo_profile') . '/assets/';

$bean = bean_create(array('type' => 'ombugallery'));
$bean->delta = 'home-gallery';
$bean->bean_style = 'slider';
$bean->title = '';
$bean->save();
ombugallery_create_slide($bean, $path . 'images/hero-carousel/01-st-johns.jpg', 'Connecting people since 1908.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/02-tillikum.jpg', "We'd like to sell you a bridge.  Seriously.");
ombugallery_create_slide($bean, $path . 'images/hero-carousel/03-fremont.jpg', 'You shall pass.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/04-marquam.jpg', 'Traveled everyday by tens of thousands.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/05-st-johns.jpg', "You keep Portland weird.  We'll keep it beautiful.");

$wrapper->field_sections[] = array(
  'value' => 'Hero',
  'settings' => array(
    'visible' => 0,
    'style' => 'white',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => 'home-gallery',
        'region' => 'content',
        'weight' => 1,
        'width' => 12,
      ),
    ),
  ),
);

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'home-intro-rte';
$bean->title = 'Manage. Measure. Control.';
$body = <<<EOD
<p>Take a ride down the blue waters of the Willamette and you'll pass under our legacy: a suite of indelible bridges which have given Portland as much of its identity as has roses, coffee, and independent bookstores.  Our bridges have brought people together for over a century, and that spirit continues to drive us today.</p>
EOD;
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();

$bean = bean_create(array('type' => 'bean_cta'));
$bean->delta = 'home-intro-cta';
$bean->title = '';
$bean->field_cta_link[LANGUAGE_NONE][0] = array(
  'title' => 'Build your bridge',
  'url' => '/contact',
);
$bean->save();

$wrapper->field_sections[] = array(
  'value' => 'Introduction',
  'settings' => array(
    'visible' => 0,
    'style' => 'white',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => 'home-intro-rte',
        'region' => 'content',
        'weight' => 1,
        'width' => 8,
      ),
      array(
        'module' => 'bean',
        'delta' => 'home-intro-cta',
        'region' => 'content',
        'weight' => 2,
        'width' => 4,
      ),
    ),
  ),
);

$wrapper->save();
