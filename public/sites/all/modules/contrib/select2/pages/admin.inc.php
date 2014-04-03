<?php

function select2_settings_form($form, &$form_state) {
  
  $form['select2_use_for_all_select_elements'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Use for all select elements'),
    '#description'   => t('If checked, Select2 plugin will be applied for all select elements on pages.'),
    '#default_value' => variable_get('select2_use_for_all_select_elements', false),
  );
  
  $form['select2_use_for_all_select_elements_for_admin_pages'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Use for all select elements on admin pages'),
      '#description'   => t('If checked, Select2 plugin will be applied for all select elements on admin pages.'),
      '#default_value' => variable_get('select2_use_for_all_select_elements_for_admin_pages', false),
      '#states' => array(
          'invisible' => array(
            ':input[name="select2_use_for_all_select_elements"]' => array('checked' => FALSE),
          ),
      ),
  );
  
  $form['select2_use_for_ac_elements'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Use for select2 for elements with autocomplete'),
      '#description'   => t('If checked, Select2 plugin will be applied for all elements with autocomplete feature.'),
      '#default_value' => variable_get('select2_use_for_ac_elements', false),
  );
  
  $form['default_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Default settings'),
    '#collapsible' => 1,
    '#collapsed' => 1,
  );
  
  $form['default_settings']['select2_min_options_count_for_search'] = array(
    '#type'    => 'textfield',
    '#title'   => t('Options count for enabling search.'),
    '#default_value' => variable_get('select2_min_options_count_for_search', 15),
    '#element_validate' => array('_select2_element_validate_integer_positive_or_zero'),
    '#description'      => t('If count of available options is less of value of this field, search box will be hided.'),
  );
  
  $form['excluded_elements'] = array(
      '#type' => 'fieldset',
      '#title' => t('Excluded elements'),
      '#collapsible' => 1,
      '#collapsed' => 1,
      '#description' => t('Lists of items, that do not need to use the Select2 plugin.'),
  );
  
  $form['excluded_elements']['select2_excluded_ids'] = array(
    '#type'          => 'textarea',
    '#title'         => t('ID\'s'),
    '#default_value' => variable_get('select2_excluded_ids', ''),
    '#description'   => t(' Enter one ID per line.') . '<br>' . t('You can define ID by regular expression, in this case wrap it by #.'),
  );
  
  $form['excluded_elements']['select2_excluded_cleasses'] = array(
      '#type'          => 'textarea',
      '#title'         => t('Classes'),
      '#default_value' => variable_get('select2_excluded_cleasses', ''),
      '#description'   => t(' Enter one class per line.'),
  );
  
  $form['excluded_elements']['select2_excluded_selectors'] = array(
      '#type'          => 'textarea',
      '#title'         => t('Selectors'),
      '#default_value' => variable_get('select2_excluded_selectors', ''),
      '#description'   => t(' Enter one selector per line.'),
  );
  
  return system_settings_form($form);
}
