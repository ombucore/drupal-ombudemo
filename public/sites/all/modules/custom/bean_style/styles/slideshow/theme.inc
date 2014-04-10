<?php

/**
 * @file
 * Theme callbacks for Slideshow bean style.
 */

/**
 * Theme callback.
 *
 * Themes a field collection as a ombuslide.
 */
function theme_bean_style_slideshow($variables) {
  $items = $variables['items'];

  $output = '';

  // If there are no slides, return empty string.
  if (!$items) {
    return $output;
  }

  // Otherwise, build up the slide items and their associated pager links.
  $items = array();
  $pager = '';
  $num = 0;

  foreach ($variables['items'] as $item) {

    // Generate a unique ID for this slide.
    $id = drupal_html_id('slide');

    // Add a pager link for this slide.
    $pager .= '<li><a href="#' . $id . '"><span>' . ++$num . '</span></a></li>';

    // Set the ID, render the slide, and push it onto our list item array.
    $item['data']['#attributes']['id'] = $id;
    $items[] = drupal_render($item['data']);
  }

  // Generate the parent list element, the corresponding pager list, and
  // previous/next links.
  $id_slides = drupal_html_id('ombuslide-slides');
  $id_pager = drupal_html_id('ombuslide-pager');
  $id_prevnext = drupal_html_id('ombuslide-prevnext');

  $slides = theme('item_list', array(
    'items' => $items,
    'attributes' => array(
      'id' => $id_slides,
      'class' => array('slides'),
    ),
  ));

  $pager = '<ul id="' . $id_pager . '" class="pager">' . $pager . '</ul>';
  $prevnext = '<ul id="' . $id_prevnext . '" class="prevnext"><li class="prev"><a href="#"><span>&lsaquo;</span></a></li><li class="next"><a href="#"><span>&rsaquo;</span></a></li></ul>';

  // Add unique id, classes, and assemble final output.
  $id = drupal_html_id('ombuslide');
  $classes = 'ombuslide ombuslide-slideshow ombuslide-' . $variables['type'];
  $output = '<div id="' . $id . '" class="' . $classes . '" data-slide-count="' . $num . '">' . $slides . $prevnext . $pager . '</div>';

  // Add js.
  $path = drupal_get_path('module', 'bean_style') . '/styles/slideshow';
  drupal_add_js($path . '/js/jquery.cycle2.js');
  drupal_add_js($path . '/js/slideshow.js');
  drupal_add_js(array('slideshow' => array($id_slides => array())), 'setting');

  // Default values. These are overriden by those from the formatter settings
  // form.  See available options at http://jquery.malsup.com/cycle2/api/
  $opts = array(
    'timeout' => 6000,
    'slides' => ' > li',
    'autoHeight' => 'calc',
    'prev' => '#' . $id_prevnext . ' > .prev > a',
    'next' => '#' . $id_prevnext . ' > .next > a',
    'pager' => '#' . $id_pager,
    'pagerTemplate' => '',
    'speed' => 600,
    'manualSpeed' => 600,
    'fx' => 'scrollHorz',
    'hideNonActive' => false
  );

  drupal_add_js(array('slideshow' => array($id_slides => $opts)), 'setting');
  drupal_add_css($path . '/css/slideshow.css');

  return $output;
}
