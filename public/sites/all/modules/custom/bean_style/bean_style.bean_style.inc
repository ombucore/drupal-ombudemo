<?php

/**
 * @file
 * Bean style hooks.
 */

/**
 * Implements hook_bean_style_info().
 */
function bean_style_bean_style_info() {
  return array(
    'slideshow' => array(
      'label'          => 'Slider',
      'class'          => 'SlideshowBeanStyle',
      'bean_types'     => array(
        'ombuslide',
      ),
    ),
    'grid' => array(
      'label'          => 'Grid',
      'class'          => 'GridBeanStyle',
      'bean_types'     => array(
        'solr_bean',
        'featuredbean',
      ),
    ),
    'list' => array(
      'label'          => 'List',
      'class'          => 'ListBeanStyle',
      'bean_types'     => array(
        'solr_bean',
        'featuredbean',
      ),
    ),
    'carousel' => array(
      'label'          => 'Carousel',
      'class'          => 'CarouselBeanStyle',
      'bean_types'     => array(
        'solr_bean',
        'featuredbean',
        'ombuslide',
      ),
    ),
  );
}

/**
 * Implements hook_bean_style_options_alter().
 */
function bean_style_bean_style_options_alter(&$options, $context) {
  // Remove default option for slideshows, since we always want a slideshow
  // style displayed.
  if ($context['bundle'] == 'ombuslide') {
    unset($options['']);
  }
}
