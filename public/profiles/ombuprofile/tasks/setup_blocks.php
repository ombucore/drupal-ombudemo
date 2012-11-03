<?php
// $Id$

/**
 * Setup site blocks.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_blocks($install_state) {
  // Enable some standard blocks.
  $default_theme = variable_get('theme_default', OMBUBASE_DEFAULT_THEME);
  $admin_theme = variable_get('admin_theme', 'seven');

  // Since this task runs after modules have been enabled, all blocks will be
  // setup to use the default theme.  So blocks in the default theme need to be
  // updated, while blocks for the admin theme need to be inserted.
  $default_blocks = array(
    array(
      'module' => 'system',
      'delta' => 'main',
      'theme' => $default_theme,
      'status' => 1,
      'weight' => 0,
      'region' => 'content',
      'pages' => '',
      'cache' => -1,
    ),
    array(
      'module' => 'system',
      'delta' => 'help',
      'theme' => $default_theme,
      'status' => 1,
      'weight' => 0,
      'region' => 'help',
      'pages' => '',
      'cache' => -1,
    ),
  );
  foreach ($default_blocks as $record) {
    $query = db_update('block');
    $query->fields($record);
    $query->condition('module', $record['module']);
    $query->condition('delta', $record['delta']);
    $query->execute();
  }

  // New module blocks to insert.
  $new_blocks = array(
    array(
      'module' => 'system',
      'delta' => 'main',
      'theme' => $admin_theme,
      'status' => 1,
      'weight' => 0,
      'region' => 'content',
      'pages' => '',
      'cache' => -1,
    ),
    array(
      'module' => 'system',
      'delta' => 'help',
      'theme' => $admin_theme,
      'status' => 1,
      'weight' => 0,
      'region' => 'help',
      'pages' => '',
      'cache' => -1,
    ),
    array(
      'module' => 'user',
      'delta' => 'login',
      'theme' => $admin_theme,
      'status' => 1,
      'weight' => 10,
      'region' => 'content',
      'pages' => '',
      'cache' => -1,
    ),
  );
  $query = db_insert('block')->fields(array('module', 'delta', 'theme', 'status', 'weight', 'region', 'pages', 'cache'));
  foreach ($new_blocks as $record) {
    $query->values($record);
  }
  $query->execute();

  $bean = bean_create(array('type' => 'ombubeans_fpohero'));
  $bean->label = 'ombubeans_fpohero';
  $bean->title = '';
  $bean->delta = 'ombubeans-fpohero';
  $bean->setValues(array (
  'view_mode' => 'default',
  'body' => '<h1>Hello, world!</h1>
    <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
    <p><a class="btn btn-primary btn-large">Learn more »</a></p>
  ',
    'width' => '12',
  ));
  bean_save($bean);


  for ($i = 0; $i < 6; $i++) {
    $bean = bean_create(array('type' => 'bean_rte_rte'));
    $bean->label = 'bean_rte_rte-' . $i;
    $bean->title = 'Rich Text Block ' . (string) ($i + 1);
    $bean->delta = 'bean-rte-rte-' . $i;
    $bean->setValues(array (
      'view_mode' => 'default',
      'width' => 3,
    ));
    $bean->field_description = array (
      'und' =>
      array (
        0 =>
        array (
          'value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details »</a></p>',
          'format' => 'comment',
          'safe_value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details »</a></p>
          ',
        ),
      ),
    );
    bean_save($bean);
  }

  bean_reset();
  drupal_static_reset('bean_get_all_beans');
  _block_rehash(OMBUBASE_DEFAULT_THEME);
}
