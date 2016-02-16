<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?>
<!doctype html>
<html id="top" lang="<?php print $language->language; ?>">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php print $head_title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0.0" />
  <?php print $head; ?>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,700,700italic,800|Open+Sans+Condensed:300,300italic,700|Lobster" rel="stylesheet" type="text/css">
  <?php print $styles; ?>
  <!--[if IE 7 ]> <script type="text/javascript">document.documentElement.className += ' ie7';</script> <![endif]-->
  <!--[if IE 8 ]> <script type="text/javascript">document.documentElement.className += ' ie8';</script> <![endif]-->
  <!--[if IE 9 ]> <script type="text/javascript">document.documentElement.className += ' ie9';</script> <![endif]-->
  <!--[if (lte IE 8) & (!IEMobile)]>
      <link href="<?php print url(drupal_get_path('theme', 'occ_theme')) . '/css/browsers/ie8.css'; ?>" rel="stylesheet" />
  <![endif]-->
  <script src="<?php print url(drupal_get_path('theme', 'boots_core')) . '/js/modernizr.js'; ?>"></script>
</head>
  <body class="<?php print $classes; ?>" <?php print $attributes;?> data-spy="scroll" data-target="#tiles-section-navigation .links" data-offset="60">
    <div id="wrap">
      <?php print $page_top; ?>
      <?php print $page; ?>
      <?php print $scripts; ?>
      <?php print $page_bottom; ?>
    </div>
    <svg height="0" width="0">
      <defs>
        <clipPath id="stinger-cta-clip-path" clipPathUnits="objectBoundingBox">
          <path d="M.50,0C.295547,0,.114028,.054166,0,.137904v.000027V1.00h1.00V.137931v-.000027C.885972,.054166,.704453,0,.50,0z"/>
        </clipPath>
      </defs>
    </svg>
  </body>
</html>
