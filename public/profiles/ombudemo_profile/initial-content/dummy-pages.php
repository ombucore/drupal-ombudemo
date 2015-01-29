<?php

/**
 * @file
 * Create dummy pages for use in search pagination.
 */

use ProfileTasks\Content\Wrapper;

$term_walk = function(&$item) {
  $item = $item->name;
};

$vocab = taxonomy_vocabulary_machine_name_load('topics');
$topics = taxonomy_get_tree($vocab->vid);
array_walk($topics, $term_walk);

$vocab = taxonomy_vocabulary_machine_name_load('tags');
$tags = taxonomy_get_tree($vocab->vid);
array_walk($tags, $term_walk);

for ($i = 1; $i < 20; $i++) {
  $wrapper = new Wrapper('node', array('type' => 'page'));
  $wrapper->title = 'Page ' . $i;
  $wrapper->body = array(
    'value' => '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>',
    'format' => 'default',
  );
  $wrapper->field_topics = $wrapper->addTerm($topics[array_rand($topics)], 'topics');
  $wrapper->field_tags[] = $wrapper->addTerm($tags[array_rand($tags)], 'tags');
  $wrapper->field_tags[] = $wrapper->addTerm($tags[array_rand($tags)], 'tags');
  $wrapper->field_tags[] = $wrapper->addTerm($tags[array_rand($tags)], 'tags');
  $wrapper->save();
}
