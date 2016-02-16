<?php

/**
 * @file
 * About page example content.
 */

use ProfileTasks\Content\Wrapper;

$wrapper = new Wrapper('node', array('type' => 'page'));
$wrapper->title = 'About';
$wrapper->field_navigation_visible = 0;

$path = drupal_get_path('profile', 'ombudemo_profile');

$wrapper->field_banner_image = $wrapper->addFile('panorama-01.jpg', $path . '/assets/images/title-banners');

$fid = $wrapper->addFile('sun.jpg', $path . '/assets');
$sun_fid = $fid['fid'];
$file = file_load($sun_fid);
$file->field_caption[LANGUAGE_NONE][0]['value'] = "Tendrils of gossamer clouds the only home we've ever known.  Dream of the mind's eye? Kindling the energy hidden in matter are creatures of the cosmos permanence of the stars Hypatia.";
file_save($file);

$fid = $wrapper->addFile('orion.jpg', $path . '/assets');
$orion_fid = $fid['fid'];
$file = file_load($orion_fid);
$file->field_caption[LANGUAGE_NONE][0]['value'] = "Gathered by gravity, a mote of dust suspended in a sunbeam.";
file_save($file);

$fid = $wrapper->addFile('rainbow-galaxy.jpg', $path . '/assets');
$rainbow_fid = $fid['fid'];
$file = file_load($rainbow_fid);
$file->field_caption[LANGUAGE_NONE][0]['value'] = "Bits of moving fluff not a sunrise but a galaxyrise!";
file_save($file);

$fid = $wrapper->addFile('earthrise.jpg', $path . '/assets');
$earthrise_fid = $fid['fid'];
$file = file_load($earthrise_fid);
$file->field_caption[LANGUAGE_NONE][0]['value'] = "Finite but unbounded Drake Equation, citizens of distant epochs. Tunguska event take root and flourish. Rig Veda from which we spring.";
file_save($file);

drupal_static_reset('file_get_stream_wrappers');
$provider = ombumedia_internet_get_provider('http://youtu.be/NjwWb_vUvB4');
$file = $provider->save();
$video_fid = $file->fid;

$body = <<<EOD
<p class="lead">
Circumnavigated preserve and cherish that pale blue dot courage of our questions vastness is bearable only through love concept of the number one.  Great turbulent clouds Drake Equation.
</p>

<p>
Globular star cluster from which we spring. Circumnavigated, the only home we've ever known venture as a patch of light courage of our questions paroxysm of global death, cosmos a very small stage in a vast cosmic arena <strong>tendrils of gossamer clouds</strong> another world trillion. Rich in heavy atoms Orion's sword, tendrils of gossamer clouds astonishment cosmos across the centuries, science.
</p>

<hr>

<h2>I am a secondary subheader</h2>

<ombumedia data-ombumedia="{&quot;fid&quot;:&quot;$orion_fid&quot;,&quot;position&quot;:&quot;left&quot;,&quot;view_mode&quot;:&quot;default&quot;,&quot;title&quot;:&quot;slide.jpg&quot;,&quot;type&quot;:&quot;image&quot;}"></ombumedia>


<p>
Cosmic fugue worldlets, <a href="https://en.wikipedia.org/wiki/Mare_Tranquillitatis">Sea of Tranquility</a> dream of the mind's eye?  Cosmic fugue Cambrian explosion kindling the energy hidden in matter finite but unbounded paroxysm of global death astonishment, circumnavigated. Worldlets, Orion's sword. Vanquish the impossible Sea of Tranquility permanence of the stars.  Drake Equation? The ash of stellar alchemy, two ghostly white figures in coveralls and helmets are soflty dancing corpus callosum.  Are creatures of the cosmos as <strong>a patch of light</strong>? Rig Veda, network of wormholes, Euclid! Rogue the only home we've ever known. Tingling of the spine, a billion trillion shores of the cosmic ocean network.
</p>

<blockquote class="pull-right">
<p>
  Tendrils of gossamer clouds vanquish the impossible Orion's sword in a cosmic ocean.
</p>
</blockquote>

<p>
Wormholes ship of the imagination descended from astronomers not a sunrise but a galaxyrise descended from astronomers, Jean-François Champollion! Ship of the imagination.  Tendrils of gossamer clouds, corpus callosum courage of our questions rich in mystery science. From which we spring Orion's sword rich in mystery science inconspicuous motes of rock and gas billions upon billions kindling the energy hidden in matter shores of the cosmic ocean, Rig Veda trillion radio telescope Hypatia finite but unbounded.
</p>

<ombumedia data-ombumedia="{&quot;fid&quot;:&quot;$rainbow_fid&quot;,&quot;position&quot;:&quot;right&quot;,&quot;view_mode&quot;:&quot;default&quot;,&quot;title&quot;:&quot;slide.jpg&quot;,&quot;type&quot;:&quot;image&quot;}"></ombumedia>

<ul>
  <li>
    Vanquish the impossible Orion's sword.
  </li>
  <li>
    Tendrils of gossamer clouds
  </li>
  <li>
    Euclid! Rogue the only home we've ever known.
  </li>
  <li>
    Preserve and cherish that pale blue dot.
  </li>
</ul>

EOD;
$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'about-rte';
$bean->title = '';
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();

$wrapper->field_sections[] = array(
  'value' => 'Exposition',
  'settings' => array(
    'visible' => 0,
    'style' => 'style-white',
    'width' => 'width-normal',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => 'about-rte',
        'region' => 'content',
        'weight' => 1,
        'width' => 10,
        'offset' => 1,
      ),
    ),
  ),
);

$bean = bean_create(array('type' => 'bean_container'));
$bean->label = 'about-tabs';
$bean->title = '';
$bean->delta = 'about-tabs';
$bean->bean_style = 'bean_container_tabbed';
$bean->setValues(array (
  'view_mode' => 'default',
));
bean_save($bean);
$layout = tiles_get_container('bean_container')->getLayout('about-tabs');

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'about-tabs-1';
$bean->title = 'Cosmic fugue';
$body = <<<EOD
<p class="lead">Bits of moving fluff not a sunrise but a galaxyrise! Cosmic fugue. Circumnavigated network of wormholes, paroxysm of global death vanquish the impossible, Euclid encyclopaedia galactica dream of the mind's eye science. Birth worldlets! The ash of stellar alchemy how far away Flatland. Star stuff harvesting star light decipherment Sea of Tranquility quasar, cosmic fugue kindling the energy hidden in matter. Cosmic fugue. Globular star cluster the sky calls to us, ship of the imagination are creatures of the cosmos emerged into consciousness science!  White dwarf, two ghostly white figures in coveralls and helmets are soflty dancing astonishment colonies shores.</p>
EOD;
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();
$layout->addBlock(array(
  'module' => 'bean',
  'delta' => $bean->delta,
  'region' => 'content',
  'width' => 12,
  'weight' => 1,
));

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'about-tabs-2';
$bean->title = 'Rogue explorations';
$body = <<<EOD
<p class="lead">Rogue explorations! Descended from astronomers explorations from which we spring, hundreds of thousands. Apollonius of Perga rich in heavy atoms. Emerged into consciousness, rich in mystery tingling of the spine billions upon billions, decipherment. Star stuff harvesting star light! Great turbulent clouds! Preserve and cherish that pale blue dot shores of the cosmic ocean. Light years tingling of the spine science hundreds of thousands star stuff harvesting star light decipherment! With pretty stories for which there's little good evidence, something incredible is waiting to be known science, a very small stage in a vast cosmic arena Hypatia white dwarf!</p>
EOD;
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();
$layout->addBlock(array(
  'module' => 'bean',
  'delta' => $bean->delta,
  'region' => 'content',
  'width' => 12,
  'weight' => 1,
));

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'about-tabs-3';
$bean->title = 'Heavy atoms';
$body = <<<EOD
<p class="lead">Across the centuries rich in heavy atoms a mote of dust suspended in a sunbeam, trillion Sea of Tranquility worldlets with pretty stories for which there's little good evidence! Something incredible is waiting to be known emerged into consciousness courage of our questions great turbulent clouds cosmic fugue, emerged into consciousness encyclopaedia galactica at the edge of forever preserve and cherish that pale blue dot concept of the number one explorations from which we spring, Jean-François Champollion! Science Hypatia! Hearts of the stars. Astonishment finite but unbounded? Dispassionate extraterrestrial observer preserve and cherish that pale blue dot.</p>
EOD;
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();
$layout->addBlock(array(
  'module' => 'bean',
  'delta' => $bean->delta,
  'region' => 'content',
  'width' => 12,
  'weight' => 1,
));

$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'about-tabs-4';
$bean->title = 'Gossamer clouds';
$body = <<<EOD
<p class="lead">Decipherment intelligent beings great turbulent clouds! Circumnavigated from which we spring ship of the imagination, a still more glorious dawn awaits, the carbon in our apple pies? Quasar, at the edge of forever? Cosmic fugue shores of the cosmic ocean white dwarf descended from astronomers intelligent beings from which we spring billions upon billions colonies courage of our questions made in the interiors of collapsing stars rich in heavy atoms. Cosmic ocean! Dream of the mind's eye? Kindling the energy hidden in matter are creatures of the cosmos permanence of the stars Hypatia, rings of Uranus, from which we spring, ship of the imagination Orion's sword.</p>
EOD;
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();
$layout->addBlock(array(
  'module' => 'bean',
  'delta' => $bean->delta,
  'region' => 'content',
  'width' => 12,
  'weight' => 1,
));

$layout->save();

$wrapper->field_sections[] = array(
  'value' => 'Rising action',
  'settings' => array(
    'visible' => 0,
    'style' => 'style-light-blue',
    'width' => 'width-wide',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => 'about-tabs',
        'region' => 'content',
        'weight' => 1,
        'width' => 12,
      ),
    ),
  ),
);

$body = <<<EOD
<h3>I am a tertiary subheader</h3>

<ombumedia data-ombumedia="{&quot;fid&quot;:&quot;$earthrise_fid&quot;,&quot;position&quot;:&quot;right&quot;,&quot;view_mode&quot;:&quot;default&quot;,&quot;title&quot;:&quot;slide.jpg&quot;,&quot;type&quot;:&quot;image&quot;}"></ombumedia>

<p>
  At the edge of forever encyclopaedia galactica Tunguska event vanquish the impossible venture, realm of the galaxies prime number, vastness is bearable only through love rich in heavy atoms Cambrian explosion network of wormholes across the centuries. A very small stage in a vast cosmic arena shores of the cosmic ocean great turbulent clouds laws of physics.
</p>

<ol>
<li>
  Vanquish the impossible Orion's sword.
</li>
<li>
  Tendrils of gossamer clouds
</li>
<li>
  Euclid! Rogue the only home we've ever known.
</li>
<li>
  Preserve and cherish that pale blue dot.
</li>
</ol>

<h4>I am a quaternary subheader</h4>

<blockquote class="pull-left">
<p>
Tingling of the spine, a billion trillion pretty stories for which there's little good evidence.
</p>
</blockquote>

<p>
Cosmic fugue worldlets, <a href="https://en.wikipedia.org/wiki/Mare_Tranquillitatis">Sea of Tranquility</a> dream of the mind's eye?  Cosmic fugue Cambrian explosion kindling the energy hidden in matter finite but unbounded paroxysm of global death astonishment, circumnavigated. Worldlets, Orion's sword. Vanquish the impossible Sea of Tranquility permanence of the stars. Drake Equation? The ash of stellar alchemy, two ghostly white figures in coveralls and helmets are soflty dancing corpus callosum.
</p>


<p>
Hundreds of thousands! Tendrils of gossamer clouds with pretty stories for which there's little good evidence gathered by gravity another world birth astonishment Sea of Tranquility trillion, hydrogen atoms light years billions upon billions?  Are creatures of the cosmos quasar hundreds of thousands Cambrian explosion dream of the mind's eye, cosmos, are creatures of the cosmos preserve and cherish that pale blue dot tingling of the spine. With pretty stories for which there's little good evidence rings of Uranus inconspicuous motes of rock and gas.
</p>


<ombumedia data-ombumedia="{&quot;fid&quot;:&quot;$video_fid&quot;,&quot;view_mode&quot;:&quot;default&quot;,&quot;title&quot;:&quot;slide.jpg&quot;,&quot;type&quot;:&quot;video&quot;}"></ombumedia>

<h5>I am a quinary subheader</h5>


<p>Rogue explorations! Descended from astronomers explorations from which we spring, hundreds of thousands. Apollonius of Perga rich in heavy atoms. Emerged into consciousness, rich in mystery tingling of the spine billions upon billions, decipherment. Star stuff harvesting star light! Great turbulent clouds! Preserve and cherish that pale blue dot shores of the cosmic ocean. Light years tingling of the spine science hundreds of thousands star stuff harvesting star light decipherment! With pretty stories for which there's little good evidence, something incredible is waiting to be known science, a very small stage in a vast cosmic arena Hypatia white dwarf!</p>

<p>
Realm of the galaxies, the ash of stellar alchemy. Cosmic fugue, birth intelligent beings globular star cluster rogue consciousness hundreds of thousands Flatland shores of the cosmic ocean tesseract.
</p>

<hr>

<h6>I am a senary subheader</h6>

<p>
Orion's sword a still more glorious dawn awaits billions upon billions the carbon in our apple pies hydrogen atoms rogue. Astonishment something incredible is waiting to be known realm of the galaxies colonies. Hypatia great turbulent clouds!
</p>

<ombumedia data-ombumedia="{&quot;fid&quot;:&quot;$sun_fid&quot;,&quot;position&quot;:&quot;right&quot;,&quot;view_mode&quot;:&quot;default&quot;,&quot;title&quot;:&quot;slide.jpg&quot;,&quot;type&quot;:&quot;image&quot;}"></ombumedia>

<p>
The sky calls to us rich in heavy atoms. Worldlets venture Euclid as a patch of light, network of wormholes cosmos dream of the mind's eye Drake Equation a very small stage in a vast cosmic arena extraordinary claims require extraordinary evidence network of wormholes Vangelis Flatland and billions upon billions upon billions upon billions upon billions upon billions upon billions.
</p>

<p><a href="/" class="btn">Click if you want</a></p>

<p>
Ship of the imagination. Tendrils of gossamer clouds, corpus callosum courage of our questions rich in mystery science. From which we spring Orion's sword rich in mystery science inconspicuous motes of rock
</p>

<p><a href="/" class="cta">Notice me and click!</a></p>

<p>
<small>Ship of the imagination. Tendrils of gossamer clouds, corpus callosum courage of our questions rich in mystery science.</small>
</p>
EOD;
$bean = bean_create(array('type' => 'bean_rte_rte'));
$bean->delta = 'about-rte-2';
$bean->title = '';
$bean->field_description[LANGUAGE_NONE][0] = array(
  'value' => $body,
  'format' => 'default',
);
$bean->save();

$bean = bean_create(array('type' => 'twitter'));
$bean->delta = 'about-twitter';
$bean->title = '';
$widget = <<<EOD
<a class="twitter-timeline" href="https://twitter.com/weareombu" data-widget-id="699304666358624256">Tweets by @weareombu</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
EOD;
$bean->setValues(array(
  'widgets' => array(
    array(
      'title' => 'OMBU Web',
      'widget' => $widget,
    ),
  ),
));
$bean->save();


$wrapper->field_sections[] = array(
  'value' => 'Resolution',
  'settings' => array(
    'visible' => 0,
    'style' => 'style-white',
    'width' => 'width-normal',
    'tiles' => array(
      array(
        'module' => 'bean',
        'delta' => 'about-rte-2',
        'region' => 'content',
        'weight' => 1,
        'width' => 10,
        'offset' => 1,
      ),
      array(
        'module' => 'bean',
        'delta' => 'about-twitter',
        'region' => 'content',
        'weight' => 2,
        'width' => 4,
        'offset' => 0,
      ),
    ),
  ),
);

$wrapper->save();
