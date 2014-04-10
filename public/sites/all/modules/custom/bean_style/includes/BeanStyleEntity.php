<?php

/**
 * @file
 * Class representing instantiated bean style entity.
 */

class BeanStyleEntity extends Entity {
  public $bean_style_id;
  public $type;
  public $bid;

  /**
   * BeanStyle object.
   *
   * @param BeanStyle
   */
  protected $bean_style;

  /**
   * Load up associated BeanStyle type.
   *
   * @return BeanStyle
   *   BeanStyle object.
   */
  public function getStyle() {
    if (!$this->bean_style) {
      $this->bean_style = bean_style_type_load($this->type);
    }

    return $this->bean_style;
  }
}
