<?php

/**
 * @file
 * Base class for bean styles.
 */

abstract class BeanStyle {
  /**
   * Info array as defined by a hook_bean_style implementation.
   *
   * @param array
   */
  protected $info;

  /**
   * Items prepared for view by prepareItems().
   *
   * @param array
   */
  protected $items;

  /**
   * Associated bean to this style.
   *
   * @param Bean
   */
  protected $bean;

  /**
   * Constructor.
   *
   * @param array $info
   *   Info array returned by hook_bean_style definition.
   */
  public function __construct($info) {
    $this->info = $info;
  }

  /**
   * Returns label for this style.
   *
   * @return string
   *   Label defined in $info array.
   */
  public function label() {
    return $this->info['label'];
  }

  /**
   * Returns name for this style.
   *
   * @return string
   *   name defined in $info array.
   */
  public function name() {
    return $this->info['name'];
  }

  /**
   * Returns items for this style.
   *
   * @return array
   *   Items built by processItems().
   */
  public function items() {
    return $this->items;
  }

  /**
   * Form for any additional style specific settings.
   */
  public function form($form, $form_state) {
    return $form;
  }

  /**
   * Prepares a build array for rendering via a style.
   */
  public function prepareView($build, $bean) {
    $this->bean = $bean;

    $this->prepareItems($build, $bean->type);

    return $build;
  }

  /**
   * Handle preparing items for rendering.
   *
   * This should be implemented by bean styles that require distinct items for
   * rendering, such as a slideshow. It should handle any specific logic needed
   * for specific bean types.
   *
   * @param array $build
   *   Build array as returned by entity_view().
   * @param string $type
   *   Type of bean
   */
  protected function prepareItems($build, $type) {
    $this->items = array();
  }
}
