<?php

/**
 * @file
 * Bean style for slideshows.
 */

class SlideshowBeanStyle extends BeanStyle {
  /**
   * Theme function to render slideshow.
   *
   * @param string
   */
  protected $theme_function = 'bean_style_slideshow';

  /**
   * Type of slideshow style.
   *
   * Added to default theme as class.
   */
  protected $slideshow_type = 'default';

  /**
   * Implements parent::prepareView().
   */
  public function prepareView($build, $bean) {
    $build = parent::prepareView($build, $bean);

    // Make sure to replace only the collection of items, not any additional
    // fields on the entity.
    $type = $this->bean->type;
    switch ($type) {
      case 'ombuslide':
        $build['field_slide'] = array(
          '#theme' => $this->theme_function,
          '#items' => $this->items,
          '#type' => $this->slideshow_type,
        );
        break;
    }

    return $build;
  }

  /**
   * Implements parent::prepareItems().
   */
  protected function prepareItems($build, $type) {
    switch ($type) {
      case 'ombuslide':
        $this->prepareFieldCollectionItems($build);
        break;
    }
  }

  /**
   * Prepare items from a field collection for rendering in a slideshow.
   */
  protected function prepareFieldCollectionItems($build) {
    foreach (element_children($build['field_slide']) as $delta) {
      $this->items[] = array(
        'data' => $build['field_slide'][$delta],
        'class' => array('item-' . $delta),
      );
    }
  }
}
