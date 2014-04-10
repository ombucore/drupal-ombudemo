<?php

/**
 * @file
 * Admin callbacks for bean_style.module.
 */

/**
 * Admin overview of bean style types.
 */
function bean_style_admin_overview() {
  $header = array(t('Name'), array('data' => t('Operations'), 'colspan' => 3));
  $rows = array();

  $styles = bean_style_get_styles();
  foreach ($styles as $name => $info) {
    $style_url_str = str_replace('_', '-', $name);

    $row[] = $info['label'];

    // Set the edit column.
    $row[] = array('data' => l(t('edit'), 'admin/structure/bean_style/manage/' . $style_url_str));

    // Manage fields.
    $row[] = array('data' => l(t('manage fields'), 'admin/structure/bean_style/manage/' . $style_url_str . '/fields'));

    // Display fields.
    $row[] = array('data' => l(t('manage display'), 'admin/structure/bean_style/manage/' . $style_url_str . '/display'));
  }

  $build['style_table'] = array(
    '#theme' => 'table',
    '#header' => $header,
    '#rows' => $rows,
    '#empty' => t('No bean styles available'),
  );

  return $build;
}

/**
 * Form constructor for bean style type editing form.
 */
function bean_style_type_form($form, $form_state, $style) {
  $form_state['style'] = $style;

  // Pull in form and field settings for type in order to set defaults.
  $form['defaults'] = array(
    '#type' => 'fieldset',
    '#title' => t('Defaults'),
    '#description' => t('Set default settings for this bean style type'),
  );
  $form['defaults'] = $style->form($form['defaults'], $form_state);
  field_attach_form('bean_style', $style, $form['defaults'], $form_state);

  return $form;
}

/**
 * Submit handler for bean style editing form.
 */
function bean_style_type_form_submit($form, &$form_state) {
  variable_set('bean_style_default_settings_' . $form_state['style']->name(), $form_state['values']);
}
