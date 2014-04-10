<?php

/**
 * @file
 * Hooks provided by the Bean styles module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Register new styles for beans.
 */
function hook_bean_styles() {
  return array(
    'style_type' => array(
      'label'          => 'My Bean Style',
      'class'          => 'BeanStyleType',
      'bean_types'     => array(
        'rte_block',
      ),
    ),
  );
}

/**
 * @} End of "addtogroup hooks".
 */
