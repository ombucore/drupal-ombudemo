<?php

/**
 * @file
 * Carousel style for beans.
 */

class CarouselBeanStyle extends ListBeanStyle {
  protected $theme_function = 'bean_style_carousel';

  protected $display_mode = 'grid';

  /**
   * Implements parent::prepareView().
   */
  public function prepareView($build, $bean) {
    $build = parent::prepareView($build, $bean);

    $type = $this->bean->type;
    switch ($type) {
      case 'ombuslide':
        $build['field_slide'] = array(
          '#theme' => $this->theme_function,
          '#items' => $this->items,
        );
        break;
    }

    return $build;
  }

  /**
   * Implements parent::prepareItems().
   */
  public function prepareItems($build, $bean) {
    parent::prepareItems($build, $bean);

    // Build items differently depending on bean type.
    switch ($type) {
      case 'ombuslide':
        $this->prepareFieldCollectionItems($build);
        break;
    }

    // Change image style to carousel.
    foreach ($this->items as $key => $item) {
      if (isset($item['field_image'])) {
        $this->items[$key]['field_image'][0]['#image_style'] = 'carousel';
      }
    }
  }

  /**
   * Prepare items from a field collection for rendering in a slideshow.
   */
  protected function prepareFieldCollectionItems($build) {
    foreach (element_children($build['field_slide']) as $delta) {
      $this->items[] = $build['field_slide'][$delta];
    }
  }
}
