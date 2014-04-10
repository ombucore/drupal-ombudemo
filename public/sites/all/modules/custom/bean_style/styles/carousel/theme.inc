<?php

/**
 * @file
 * Theme callbacks for carousel bean style.
 */

/**
 * Carousel theme.
 */
function theme_bean_style_carousel(&$variables) {
  $items = $variables['items'];

  // Render each item.
  $list_items = array();

  // Add the carousel items to a list array.
  foreach ($items as $item) {
    $list_items[] = array('data' => drupal_render($item));
  }

  // Add an additional list item to act as a dynamic shim that keeps
  // the height of the carousel list element at its maximum; to prevent
  // vertical "wiggle" as items scroll from side to side.
  $list_items[] = array('data' => '<span>Return to the first item</span>', 'class' => array('spacer'));

  // Add Javascript.
  $path = drupal_get_path('module', 'bean_style') . '/styles/carousel';
  drupal_add_js($path . '/js/jquery.event.move.js');
  drupal_add_js($path . '/js/jquery.event.swipe.js');
  drupal_add_js($path . '/js/carousel-bean.js');
  drupal_add_css($path . '/css/carousel.css');

  // Return rendered bean content.
  $list = theme('item_list', array('items' => $list_items, 'attributes' => array('class' => array('results'))));
  return '<div class="bean-style-carousel" data-index-active="0" data-count-items="' . count($items) . '"><div class="bean-style-carousel-inner">' . $list . '</div></div>';
}
