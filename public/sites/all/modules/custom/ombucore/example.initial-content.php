<?php

/**
 * @file
 * Example file for loading up content during a build.
 *
 * To use, create a new file in a directory called `initial-content` in the
 * active profile directory, e.g. for a profile named "site_profile":
 *
 *   profiles/site_profile/initial-content/page1.php
 *
 * Then, to connect to a node created during the AddContent task, in
 * AddContent.php in the structured menu array, add a '#file' key to an item to
 * load up the proper content, e.g.:
 *
 *   @code
 *
 *   $menu_nodes = array(
 *     'main-menu' => array(
 *       'Page One' => array('#file' => 'page1.php'),
 *     ),
 *   );
 *
 *   @endcode
 *
 * Note that one file should only be responsible for creating one node, in order
 * for the AddContent task to properly link up nodes for the structured menu
 * array.
 */

use OmbuCore\Content\Wrapper;

// Create a new wrapper around a new node. The first parameter is the type of
// entity to create (most often 'node'). Any parameters defined in the second
// parameter array will be passed on to the created node. Most often this will
// just be the type of node to create (e.g. 'page'), but could also be used to
// set properties on the node (e.g. uid or status).
$wrapper = new Wrapper('node', array('type' => 'page'));

// To set a property on the node object, simply set the property on the wrapper
// object.
$wrapper->title = 'Page One';

// To set field values, most commonly you can just set the property
$wrapper->field_text = 'An example text field';

// To set textarea fields, you have to explicitly set the value and format
// properties using an array. To avoid having a big block of HTML in this file,
// it's recommended to load up an external html file.
$wrapper->body = array(
  'value' => file_get_contents('page1.html'),
  'format' => 'default',
);

// To assign an image, use the addFile() helper method.
$path = drupal_get_path('profile', 'site_profile');
$wrapper->field_image = $this->addFile('testImage.png', $path);

// To load in taxonomy terms, use the addTerm() helper method, which will load
// the appropriate tid for the passed term. If no term exists, a new one will be
// created. This also illustrates how to add multiple values to a field.
$wrapper->field_terms[] = $this->addTerm('term 1', 'vocabulary');
$wrapper->field_terms[] = $this->addTerm('term 2', 'vocabulary');

// To create blocks, use the addBean() helper method. This will ensure beans are
// properly saved and assigned to this content on save().
$bean = $wrapper->addBean('rte_bean', 'content', 6);
$bean->title = 'Test Bean 1';
$bean->body->value = '<p>Lorem ipsum</p>';
$bean->body->format = 'default';

$bean = $wrapper->addBean('rte_bean', 'content', 6);
$bean->title = 'Test Bean 2';
$bean->body->value = '<p>Lorem ipsum</p>';
$bean->body->format = 'default';

// Finally, just save the wrapper and everything will be properly handled.
$wrapper->save();
