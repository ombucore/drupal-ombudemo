<?php

/**
 * @file
 * Default theme implementation to display a region.
 *
 * Available variables:
 * - $content: The content for this region, typically blocks.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - region: The current template type, i.e., "theming hook".
 *   - region-[name]: The name of the region with underscores replaced with
 *     dashes. For example, the page_top region would have a region-page-top class.
 * - $region: The name of the region variable as defined in the theme's .info file.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 *
 * @see template_preprocess()
 * @see template_preprocess_region()
 * @see template_process()
 */
?>
<?php if ($content): ?>
  <div data-type="region" data-name="section-arch" class="<?php print $classes ?>" id="<?php print $id . '-arch' ?>"<?php print $attributes ?>>
    <div class="container">
      <div class="arch">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 320 20" enable-background="new 0 0 320 20" xml:space="preserve">
          <path fill="#8FA7CC" d="M320,20v-0.004C283.511,7.854,225.425,0,160,0S36.489,7.854,0,19.996V20H320z"/>
        </svg>
      </div>
    </div>
  </div>
  <div data-type="region" data-name="<?php print $region ?>" class="<?php print $classes; ?>">
    <?php print $content; ?>
  </div>
<?php endif; ?>
