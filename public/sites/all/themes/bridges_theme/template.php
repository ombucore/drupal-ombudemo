<?php

/**
 * @file
 * Theme overrides for Stumptown Bridges theme.
 */

/**
 * Overrides theme_bean_style_carousel().
 */
function bridges_theme_bean_style_carousel(&$variables) {

  // Add bean style assets.
  $path = drupal_get_path('module', 'bean_style') . '/styles/carousel';
  drupal_add_js($path . '/js/vendor/owl.carousel.js');
  drupal_add_js($path . '/js/bean-style-carousel.js');
  drupal_add_css($path . '/css/bean-style-carousel.css');

  $style = $variables['type'];

  $classes = 'bean-style-carousel';
  $options .= ' data-nav="false"';
  $options  = ' data-items="1"';
  $options .= ' data-items-480="1"';
  $options .= ' data-items-768="1"';
  $options .= ' data-items-992="1"';
  $options .= ' data-margin="0"';
  $options .= ' data-margin-480="0"';
  $options .= ' data-margin-768="0"';
  $options .= ' data-margin-992="0"';
  $options .= ' data-stage-padding="0"';
  $options .= ' data-stage-padding-480="0"';
  $options .= ' data-stage-padding-768="0"';
  $options .= ' data-stage-padding-992="0"';

  // Render markup for collection of items.
  $list = '<div class="' . $classes . '"><div class="items"' . $options . '>';
  foreach ($variables['items'] as $item) {
    $render = array('data' => drupal_render($item));
    $list .= '<div class="item">' . $render['data'] . '</div>';
  }
  $list .= "</div></div>";

  return $list;
}
