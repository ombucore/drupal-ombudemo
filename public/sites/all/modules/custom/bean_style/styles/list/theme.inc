<?php

/**
 * @file
 * Theme callbacks for list bean style.
 */

/**
 * Theme list style.
 */
function theme_bean_style_list($variables) {
  $items = $variables['items'];
  $type = !empty($variables['type']) ? $variables['type'] : 'list';

  $list_items = array();
  foreach ($items as $item) {
    $list_items[] = drupal_render($item);
  }

  $list = theme('item_list', array('items' => $list_items, 'attributes' => array('class' => array('results'))));
  return '<div class="bean-style-' . $type . '"><div class="bean-style-inner">' . $list . '</div></div>';
}
