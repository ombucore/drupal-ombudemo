<?php

/**
 * @file
 * Bridges page example content.
 */

use ProfileTasks\Content\Wrapper;

$wrapper = new Wrapper('node', array('type' => 'page'));
$wrapper->title = 'Bridges';
$wrapper->field_navigation_visible = 1;

$path = drupal_get_path('profile', 'ombudemo_profile');

$wrapper->field_banner_image = $wrapper->addFile('panorama-02.jpg', $path . '/assets/images/title-banners');

$wrapper->field_subtitle = 'A legacy of exceptional bridges, standing strong for over a century.';

$wrapper->body = array(
  'value' => '<p>Urna dolor, dolor lectus porttitor cum? Scelerisque scelerisque rhoncus nec. Arcu proin. Nunc elit ultricies et tristique et mauris aliquet dolor ultrices cras eu lorem adipiscing? Sed cras, aenean sit eros a, pulvinar, placerat aenean ultrices nascetur nunc adipiscing porta! Platea velit. Odio augue, tempor cursus? Pellentesque eu, lorem sagittis, ut elementum sit tempor lorem natoque? Facilisis magna rhoncus turpis? Ut scelerisque mid porttitor dignissim. Vel! Massa scelerisque quis ultricies natoque magna, et odio elementum. Risus, urna proin dis parturient! Risus. Nunc vut tempor, arcu, natoque ac cras scelerisque duis. In lundium nunc turpis tempor odio scelerisque tempor, natoque vel, sagittis dignissim, ac odio. Dictumst in vel natoque, eros dictumst tincidunt aliquet? Sit velit, nunc dapibus porttitor vel porta porta.</p>',
  'format' => 'default',
);

$ipsum = <<<EOD
<p>Realm of the galaxies corpus callosum hundreds of thousands kindling the energy hidden in matter Vangelis decipherment culture rich in heavy atoms, Vangelis corpus callosum emerged into consciousness the carbon in our apple pies, are creatures of the cosmos bits of moving fluff inconspicuous motes of rock and gas realm of the galaxies explorations extraplanetary, vastness is bearable only through love concept of the number one across the centuries rich in mystery, across the centuries decipherment paroxysm of global death prime number, a mote of dust suspended in a sunbeam finite but unbounded with pretty stories for which there's little good evidence.</p>
<p>Another world of brilliant syntheses. Shores of the cosmic ocean Flatland Drake Equation? Hydrogen atoms? Cambrian explosion Jean-François Champollion inconspicuous motes of rock and gas, finite but unbounded with pretty stories for which there's little good evidence! Hypatia, the sky calls to us birth made in the interiors of collapsing stars, emerged into consciousness. Intelligent beings concept of the number one science brain is the seed of intelligence? Astonishment Cambrian explosion science a still more glorious dawn awaits! Rich in heavy atoms with pretty stories for which there's little good evidence Jean-François Champollion vanquish the impossible, emerged into consciousness billions upon billions, Vangelis muse about.</p>
<p>How far away ship of the imagination something incredible is waiting to be known. Gathered by gravity kindling the energy hidden in matter of brilliant syntheses. Permanence of the stars. Rig Veda vastness is bearable only through love concept of the number one realm of the galaxies permanence of the stars billions upon billions the sky calls to us Tunguska event rogue the sky calls to us vanquish the impossible inconspicuous motes of rock and gas? Venture birth bits of moving fluff, the only home we've ever known, not a sunrise but a galaxyrise a mote of dust suspended in a sunbeam corpus callosum the ash of stellar alchemy science, Euclid!</p>
<p>Radio telescope gathered by gravity. Stirred by starlight, Drake Equation, Jean-François Champollion worldlets tesseract cosmos light years how far away Hypatia. Ship of the imagination a mote of dust suspended in a sunbeam, across the centuries a billion trillion. Decipherment paroxysm of global death a very small stage in a vast cosmic arena, shores of the cosmic ocean network of wormholes astonishment venture corpus callosum Jean-François Champollion extraplanetary. Billions upon billions brain is the seed of intelligence and billions upon billions upon billions upon billions upon billions upon billions upon billions?</p>
EOD;

// St. Johns
// -----------------------------------------------------------------------------

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'bridges-rte-1';
$bean->title = '';
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $ipsum,
  'format' => 'default',
);
$bean->save();

$wrapper->field_sections[] = array(
  'value' => 'St. Johns',
  'settings' => array(
    'visible' => 1,
    'style' => 'style-blue',
    'width' => 'width-normal',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => $bean->delta,
        'region' => 'content',
        'weight' => 1,
        'width' => 12,
        'offset' => 0,
      ),
    ),
  ),
);

// Tilikum Crossing
// -----------------------------------------------------------------------------

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'bridges-rte-2';
$bean->title = '';
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $ipsum,
  'format' => 'default',
);
$bean->save();

$wrapper->field_sections[] = array(
  'value' => 'Tilikum Crossing',
  'settings' => array(
    'visible' => 1,
    'style' => 'style-light-blue',
    'width' => 'width-normal',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => $bean->delta,
        'region' => 'content',
        'weight' => 1,
        'width' => 12,
        'offset' => 0,
      ),
    ),
  ),
);

// Burnside
// -----------------------------------------------------------------------------

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'bridges-rte-3';
$bean->title = '';
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $ipsum,
  'format' => 'default',
);
$bean->save();

$wrapper->field_sections[] = array(
  'value' => 'Burnside',
  'settings' => array(
    'visible' => 1,
    'style' => 'style-white',
    'width' => 'width-normal',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => $bean->delta,
        'region' => 'content',
        'weight' => 1,
        'width' => 12,
        'offset' => 0,
      ),
    ),
  ),
);

// The Marquam
// -----------------------------------------------------------------------------

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'bridges-rte-4';
$bean->title = '';
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $ipsum,
  'format' => 'default',
);
$bean->save();

$wrapper->field_sections[] = array(
  'value' => 'The Marquam',
  'settings' => array(
    'visible' => 1,
    'style' => 'style-light-blue',
    'width' => 'width-normal',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => $bean->delta,
        'region' => 'content',
        'weight' => 1,
        'width' => 12,
        'offset' => 0,
      ),
    ),
  ),
);

// -----------------------------------------------------------------------------

$wrapper->save();



