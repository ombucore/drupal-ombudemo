<?php

/**
 * @file
 * Bridges page example content.
 */

use ProfileTasks\Content\Wrapper;

$wrapper = new Wrapper('node', array('type' => 'page'));
$wrapper->title = 'Bridges';

$path = drupal_get_path('profile', 'ombudemo_profile');

$wrapper->field_banner_image = $wrapper->addFile('panorama-02.jpg', $path . '/assets/images/title-banners');

$wrapper->field_summary = 'View our beautiful bridges';

$wrapper->body = array(
  'value' => '<p>Urna dolor, dolor lectus porttitor cum? Scelerisque scelerisque rhoncus nec. Arcu proin. Nunc elit ultricies et tristique et mauris aliquet dolor ultrices cras eu lorem adipiscing? Sed cras, aenean sit eros a, pulvinar, placerat aenean ultrices nascetur nunc adipiscing porta! Platea velit. Odio augue, tempor cursus? Pellentesque eu, lorem sagittis, ut elementum sit tempor lorem natoque? Facilisis magna rhoncus turpis? Ut scelerisque mid porttitor dignissim. Vel! Massa scelerisque quis ultricies natoque magna, et odio elementum. Risus, urna proin dis parturient! Risus. Nunc vut tempor, arcu, natoque ac cras scelerisque duis. In lundium nunc turpis tempor odio scelerisque tempor, natoque vel, sagittis dignissim, ac odio. Dictumst in vel natoque, eros dictumst tincidunt aliquet? Sit velit, nunc dapibus porttitor vel porta porta.</p>',
  'format' => 'default',
);

$wrapper->save();
