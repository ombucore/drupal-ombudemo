<?php
// $Id$

/**
 * Setup XMLsitemap settings.
 *
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_xmlsitemap() {
    $include = array(
        'status' => 1,
        'priority' => '0.5',
    );
    $exclude = array(
        'status' => 0,
        'priority' => '0.5',
    );

    // Node Settings
    // Ex: variable_set('xmlsitemap_settings_node_{node_type}', $settings);
    variable_set('xmlsitemap_settings_node_page', $include);

    variable_set('xmlsitemap_rebuild_needed', TRUE);
    variable_set('xmlsitemap_regenerate_needed', TRUE);

    // Generate Sitemap
    module_load_include('generate.inc', 'xmlsitemap');

    // Build a list of rebuildable link types.
    $rebuild_types = xmlsitemap_get_rebuildable_link_types();

    // Run the batch process.
    xmlsitemap_run_progressive_batch('xmlsitemap_rebuild_batch', $rebuild_types, TRUE);
}
