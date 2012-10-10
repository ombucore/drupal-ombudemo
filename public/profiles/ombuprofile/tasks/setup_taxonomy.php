<?php
// $Id$

/**
 * Setup taxonomy vocabulary.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_taxonomy($install_state) {
  // Disable by default, since there aren't any vocabularies yet
  return;

  // Vocabulary creation handled by features.
  $vocab = taxonomy_vocabulary_machine_name_load('department');

  // But features doesn't handle term creation.
  $terms = array(
    'Term 1',
    'Term 2',
  );
  foreach ($terms as $term_name) {
    $term = new stdClass;
    $term->vid = $vocab->vid;
    $term->name = $term_name;
    $term->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla ante in lorem vehicula dignissim. Quisque non gravida purus. Suspendisse congue commodo suscipit. Praesent suscipit vehicula euismod. Duis quis quam nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed et arcu magna, vitae tempor dui. Nam venenatis consectetur enim, pretium laoreet leo dictum sed.';
    taxonomy_term_save($term);
  }
}
