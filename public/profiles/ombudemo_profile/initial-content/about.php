<?php

/**
 * @file
 * About page example content.
 */

use ProfileTasks\Content\Wrapper;

$wrapper = new Wrapper('node', array('type' => 'page'));
$wrapper->title = 'About';

$path = drupal_get_path('profile', 'ombudemo_profile');

$fid = $wrapper->addFile('sun.jpg', $path . '/assets');
$sun_fid = $fid['fid'];
$file = file_load($sun_fid);
$file->field_caption[LANGUAGE_NONE][0]['value'] = "Vanquish the impossible Orion's sword. Tendrils of gossamer clouds Euclid! Rogue the only home we've ever known. Preserve and cherish that pale blue dot.";
file_save($file);

$fid = $wrapper->addFile('orion.jpg', $path . '/assets');
$orion_fid = $fid['fid'];
$file = file_load($orion_fid);
$file->field_caption[LANGUAGE_NONE][0]['value'] = "Vanquish the impossible Orion's sword. Tendrils of gossamer clouds Euclid! Rogue the only home we've ever known. Preserve and cherish that pale blue dot.";
file_save($file);

drupal_static_reset('file_get_stream_wrappers');
$provider = ombumedia_internet_get_provider('http://youtu.be/oP4I3uDMOVw');
$file = $provider->save();
$video_fid = $file->fid;

$body = <<<EOD
<p class="lead">
Circumnavigated preserve and cherish that pale blue dot courage of our questions vastness is bearable only through love concept of the number one.  Great turbulent clouds Drake Equation.
</p>

<p>
Globular star cluster from which we spring. Circumnavigated, the only home we've ever known venture as a patch of light courage of our questions paroxysm of global death, cosmos a very small stage in a vast cosmic arena <strong>tendrils of gossamer clouds</strong> another world trillion. Rich in heavy atoms Orion's sword, tendrils of gossamer clouds astonishment cosmos across the centuries, science.
</p>

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

<h2>I am a secondary subheader</h2>

<ombumedia data-ombumedia="{&quot;fid&quot;:&quot;$orion_fid&quot;,&quot;position&quot;:&quot;left&quot;,&quot;view_mode&quot;:&quot;default&quot;,&quot;title&quot;:&quot;slide.jpg&quot;,&quot;type&quot;:&quot;image&quot;}"></ombumedia>


<p>
Cosmic fugue worldlets, Sea of Tranquility dream of the mind's eye?  Cosmic fugue Cambrian explosion kindling the energy hidden in matter finite but unbounded paroxysm of global death astonishment, circumnavigated. Worldlets, Orion's sword. Vanquish the impossible Sea of Tranquility permanence of the stars.  Drake Equation? The ash of stellar alchemy, two ghostly white figures in coveralls and helmets are soflty dancing corpus callosum.  Are creatures of the cosmos as <strong>a patch of light</strong>? Rig Veda, network of wormholes, Euclid! Rogue the only home we've ever known. Tingling of the spine, a billion trillion shores of the cosmic ocean network.
</p>

<blockquote class="pull-right">
<p>
  Cosmic fugue worldlets, Sea of Tranquility dream of the mind's eye? Drake Equation? The ash of stellar alchemy!
</p>
</blockquote>

<p>
Wormholes ship of the imagination descended from astronomers not a sunrise but a galaxyrise descended from astronomers, Jean-François Champollion! Ship of the imagination.  Tendrils of gossamer clouds, corpus callosum courage of our questions rich in mystery science. From which we spring Orion's sword rich in mystery science inconspicuous motes of rock and gas billions upon billions kindling the energy hidden in matter shores of the cosmic ocean, Rig Veda trillion radio telescope Hypatia finite but unbounded.
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

<h3>I am a tertiary subheader</h3>

<p>
  At the edge of forever encyclopaedia galactica Tunguska event vanquish the impossible venture, realm of the galaxies prime number, vastness is bearable only through love rich in heavy atoms Cambrian explosion network of wormholes across the centuries. A very small stage in a vast cosmic arena shores of the cosmic ocean great turbulent clouds laws of physics.
</p>

<p>
A billion trillion descended from astronomers. Encyclopaedia galactica Rig Veda from which we spring Flatland finite but unbounded kindling the energy hidden in matter. Vanquish the impossible Orion's sword colonies light years shores of the cosmic ocean tesseract and billions upon billions upon billions upon billions upon billions upon billions upon billions.
</p>

<h4>I am a quaternary subheader</h4>

<blockquote class="pull-left">
<p>
Cosmic fugue worldlets, Sea of Tranquility dream of the mind's eye? Drake Equation? The ash of stellar alchemy!
</p>
</blockquote>

<p>
Cosmic fugue worldlets, Sea of Tranquility dream of the mind's eye?  Cosmic fugue Cambrian explosion kindling the energy hidden in matter finite but unbounded paroxysm of global death astonishment, circumnavigated. Worldlets, Orion's sword. Vanquish the impossible Sea of Tranquility permanence of the stars. Drake Equation? The ash of stellar alchemy, two ghostly white figures in coveralls and helmets are soflty dancing corpus callosum.azz
</p>

<h5>I am a quinary subheader</h5>

<p>
Hundreds of thousands! Tendrils of gossamer clouds with pretty stories for which there's little good evidence gathered by gravity another world birth astonishment Sea of Tranquility trillion, hydrogen atoms light years billions upon billions?  Are creatures of the cosmos quasar hundreds of thousands Cambrian explosion dream of the mind's eye, cosmos, are creatures of the cosmos preserve and cherish that pale blue dot tingling of the spine. With pretty stories for which there's little good evidence rings of Uranus inconspicuous motes of rock and gas.
</p>

<hr>

<p>
Realm of the galaxies, the ash of stellar alchemy. Cosmic fugue, birth intelligent beings globular star cluster rogue consciousness hundreds of thousands Flatland shores of the cosmic ocean tesseract.
</p>

<ombumedia data-ombumedia="{&quot;fid&quot;:&quot;$video_fid&quot;,&quot;view_mode&quot;:&quot;default&quot;,&quot;title&quot;:&quot;slide.jpg&quot;,&quot;type&quot;:&quot;video&quot;}"></ombumedia>

<h6>I am a senary subheader</h6>

<p>
Orion's sword a still more glorious dawn awaits billions upon billions the carbon in our apple pies hydrogen atoms rogue. Astonishment something incredible is waiting to be known realm of the galaxies colonies. Hypatia great turbulent clouds!
</p>

<p>
The sky calls to us rich in heavy atoms. Worldlets venture Euclid as a patch of light, network of wormholes cosmos dream of the mind's eye Drake Equation a very small stage in a vast cosmic arena extraordinary claims require extraordinary evidence network of wormholes Vangelis Flatland and billions upon billions upon billions upon billions upon billions upon billions upon billions.
</p>

<ombumedia data-ombumedia="{&quot;fid&quot;:&quot;$sun_fid&quot;,&quot;position&quot;:&quot;right&quot;,&quot;view_mode&quot;:&quot;default&quot;,&quot;title&quot;:&quot;slide.jpg&quot;,&quot;type&quot;:&quot;image&quot;}"></ombumedia>


<a href="/" class="btn">Click if you want</a>

<p>
Ship of the imagination. Tendrils of gossamer clouds, corpus callosum courage of our questions rich in mystery science. From which we spring Orion's sword rich in mystery science inconspicuous motes of rock
</p>

<a href="/" class="btn">Notice me and click!</a>

<p>
Ship of the imagination. Tendrils of gossamer clouds, corpus callosum courage of our questions rich in mystery science. From which we spring Orion's sword.
</p>
EOD;

$wrapper->body = array(
  'value' => $body,
  'format' => 'default',
);

$wrapper->save();
