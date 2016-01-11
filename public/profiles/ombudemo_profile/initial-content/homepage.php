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
$bean->bean_style = 'carousel';
$bean->title = '';
$bean->save();
ombugallery_create_slide($bean, $path . 'images/hero-carousel/01-st-johns.jpg', 'Connecting people since 1908.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/08-nightscape.jpg', 'We’ve added color to the city.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/07-tilt-shift.jpg', 'Functional, yet playful.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/06-hawthorne.jpg', 'You keep Portland weird.  We’ll keep it beautiful.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/14-fremont-with-st-helens.jpg', 'Act now and we’ll throw in a volcano.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/16-tillikum-at-night.jpg', 'Light cycles not included.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/11-burnside-open.jpg', 'You shall not pass.');
ombugallery_create_slide($bean, $path . 'images/hero-carousel/09-night-long-exposure.jpg', 'Safely traveled by thousands every day.');

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
$bean->title = '';
$body = <<<EOD
<p class="lead">Take a ride down the blue waters of the Willamette and you’ll pass under our legacy: a suite of indelible bridges which have given Portland as much of its identity as has roses, coffee, and independent bookstores.  Our bridges have brought people together for over a century, and that spirit continues to drive us today.</p>
EOD;
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();

$bean = bean_create(array('type' => 'bean_cta'));
$bean->style = 'primary';
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

$bean = new Wrapper('bean', array('type' => 'bean_callout'));
$bean->title = 'Why Stumptown Bridges?';
$bean->value()->delta = 'home-callout';

$callouts = array(
  array(
    'title' => 'Timeless design',
    'image' => '01-design.png',
    'body' => ' <p>A bridge will stand for centuries, outliving the architectural trends and cultural fads that come and go around it.  Our master designers understand this; they reach for the future while cherishing the past.</p>',
  ),
  array(
    'title' => 'Sturdy construction',
    'image' => '02-construction.png',
    'body' => '<p>Through earthquakes and floods, hurricanes and heat waves, our bridges stand proudly.  Our rigorous construction processes ensure longetivy for the final structure and safety for all of its passengers.</p>',
  ),
  array(
    'title' => 'Adaptive access',
    'image' => '03-access.png',
    'body' => '<p>Our bridges were once traveled by horse and buggy.  Now they are traveled by bicycle and light rail.  Soon, we can expect jetpacks and modes of which we haven’t dreamt — but will have had the foresight to accommodate!</p>',
  ),
);
foreach ($callouts as $callout) {
  $fc = $bean->addFieldCollection('field_callout_item');
  $fc->field_callout_title = $callout['title'];
  $fc->field_callout_image = $bean->addFile($callout['image'], $path . '/images/why-stumptown');
  $fc->field_callout_description = array(
    'value' => $callout['body'],
    'format' => 'default',
  );
}
$bean->save();
$callout_delta = $bean->value()->delta;

$bean = bean_create(array('type' => 'bean_container'));
$bean->label = 'home-container';
$bean->title = 'Tour our projects';
$bean->delta = 'home-container';
$bean->bean_style = 'bean_container';
$bean->setValues(array (
  'view_mode' => 'default',
));
bean_save($bean);
$layout = tiles_get_container('bean_container')->getLayout('home-container');

drupal_static_reset('file_get_stream_wrappers');
$bean = new Wrapper('bean', array('type' => 'bean_media'));
$bean->value()->delta = 'home-media-0';
$provider = ombumedia_internet_get_provider('http://youtu.be/-iiSVOXjpxQ');
$file = $provider->save();
$file->field_caption[LANGUAGE_NONE][0]['value'] = 'Aerial tour, 2016';
$bean->field_bean_media = (array) $file;
$bean->save();
$layout->addBlock(array(
  'module' => 'bean',
  'delta' => $bean->value()->delta,
  'region' => 'content',
  'width' => 12,
  'weight' => 1,
));

$bean = new Wrapper('bean', array('type' => 'bean_media'));
$bean->value()->delta = 'home-media-1';
$provider = ombumedia_internet_get_provider('http://youtu.be/huDToAfTnRI');
$file = $provider->save();
$file->field_caption[LANGUAGE_NONE][0]['value'] = 'Bridgetown, 2016';
$bean->field_bean_media = (array) $file;
$bean->save();
$layout->addBlock(array(
  'module' => 'bean',
  'delta' => $bean->value()->delta,
  'region' => 'content',
  'width' => 12,
  'weight' => 1,
));

$bean = bean_create(array('type' => 'bean_cta'));
$bean->style = 'secondary';
$bean->delta = 'home-secondary-cta';
$bean->title = '';
$bean->field_cta_link[LANGUAGE_NONE][0] = array(
  'title' => 'More videos',
  'url' => 'https://goo.gl/FYpxpV',
);
$bean->save();
$layout->addBlock(array(
  'module' => 'bean',
  'delta' => $bean->delta,
  'region' => 'content',
  'width' => 12,
  'weight' => 3,
));

$layout->save();

$wrapper->field_sections[] = array(
  'value' => 'Why us?',
  'settings' => array(
    'visible' => 0,
    'style' => 'white',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => $callout_delta,
        'region' => 'content',
        'weight' => 1,
        'width' => 7,
      ),
      array(
        'module' => 'bean',
        'delta' => 'home-container',
        'region' => 'content',
        'weight' => 2,
        'width' => 4,
        'offset' => 1,
      ),
    ),
  ),
);

$file = $wrapper->addFile('oregon-construction-specifications.pdf', $path . '/documents');
$file = file_load($file['fid']);
$file->filename = 'Technical Specifications';
file_save($file);
$tag = ombumedia_file_embed_tag(array('fid' => $file->fid));

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'home-rte-last';
$bean->title = 'Built to last for centuries';
$body = <<<EOD
<p>Our bridges are carefully designed to withstand wind gusts of up to 80 MPH and earthquakes registering 7.9 on the Richter scale. Our elegant passive damper technology counteracts all naturally occurring forces, maintaining stability in unpredictable conditions.</p> <p>$tag Download our technical specifications to review all design and construction details.</p>
EOD;
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();

$bean = bean_create(array('type' => 'ombugallery'));
$bean->delta = 'home-gallery-grid';
$bean->bean_style = 'grid';
$bean->title = 'Our legacy in photos';
$bean->save();
ombugallery_create_slide($bean, $path . 'images/legacy-photos/01-vintage.jpg');
ombugallery_create_slide($bean, $path . 'images/legacy-photos/02-vintage.jpg');
ombugallery_create_slide($bean, $path . 'images/legacy-photos/03-vintage.jpg');
ombugallery_create_slide($bean, $path . 'images/legacy-photos/04-vintage.jpg');

$wrapper->field_sections[] = array(
  'value' => 'Supporting information',
  'settings' => array(
    'visible' => 0,
    'style' => 'light_blue',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => 'home-rte-last',
        'region' => 'content',
        'weight' => 1,
        'width' => 7,
      ),
      array(
        'module' => 'bean',
        'delta' => 'home-gallery-grid',
        'region' => 'content',
        'weight' => 2,
        'width' => 4,
        'offset' => 1,
      ),
    ),
  ),
);

$bean = bean_create(array('type' => 'bean_cta'));
$bean->style = 'stinger';
$bean->delta = 'home-stinger-cta';
$bean->title = 'Reach the other side';
$bean->field_cta_image[LANGUAGE_NONE][0] = $wrapper->addFile('cta-st-johns-tinted.jpg', $path . '/images/page-sections');
$bean->field_cta_link[LANGUAGE_NONE][0] = array(
  'title' => 'Build your bridge',
  'url' => '/contact',
);
$bean->save();

$wrapper->field_sections[] = array(
  'value' => 'Call to action',
  'settings' => array(
    'visible' => 0,
    'style' => 'blue',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => 'home-stinger-cta',
        'region' => 'content',
        'weight' => 1,
        'width' => 12,
      ),
    ),
  ),
);

$wrapper->save();
