<?php

/**
 *
 * @file
 * Default theme implementation to display a section within a sectioned page.
 *
 * Available variables:
 * - $section_title: Title of section
 * - $tiles: render array of available tiles.
 *
 */
?>
<?php
if (!empty($section_title) && $title_visible) {
  $classes .= ' has-title';
}
?>
<?php $stripped_classes = str_replace(array('contextual-links-region', 'tiles-section'), array('', ''), $classes); ?>
<div data-type="region-theme" data-name="section-arch" class="<?php print $stripped_classes ?>" id="<?php print $id . '-arch' ?>"<?php print $attributes ?>>
  <div class="container">
    <div class="arch">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 320 20" enable-background="new 0 0 320 20" xml:space="preserve">
        <path fill="#8FA7CC" d="M320,20v-0.004C283.511,7.854,225.425,0,160,0S36.489,7.854,0,19.996V20H320z"/>
      </svg>
    </div>
  </div>
</div>
<div data-type="region" data-name="section" class="<?php print $classes ?>" id="<?php print $id ?>"<?php print $attributes ?>>
  <div class="container header">
    <div class="row">
      <div class="header block col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php if (!empty($section_title) && $title_visible): ?>
          <h2><?php print $section_title ?></h2>
        <?php endif; ?>
        <?php print render($title_suffix) ?>
      </div>
    </div>
  </div>
  <div class="container content" data-name-friendly="<?php print t('Section: ') . $section_title; ?>" data-name="content" data-type="section" data-tiles-selector="<?php print $selector ?>">
    <?php print render($tiles) ?>
  </div>
  <div class="container footer">
    <div class="row">
      <div class="block col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p class="top-link"><a href="#wrap">Back to top</a></p>
      </div>
    </div>
  </div>
</div>
