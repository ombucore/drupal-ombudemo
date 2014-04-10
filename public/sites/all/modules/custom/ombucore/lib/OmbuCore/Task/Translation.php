<?php

/**
 * @file
 * Setup translations.
 */

namespace OmbuCore\Task;

class Translation extends Task {
  /**
   * Boolean on whether or not to run translations.
   *
   * FALSE by default
   *
   * @param boolean
   */
  protected $enabled = FALSE;

  /**
   * List of languages to enable, by language code.
   *
   * @param array
   */
  protected $languages = array();

  /**
   * List of language modules to enable.
   *
   * @param array
   */
  protected $modules = array();

  /**
   * List of entity types to enable translations on.
   *
   * @param array
   */
  protected $entity_types = array();

  /**
   * Implements parent::settings().
   */
  public function settings() {
    $settings = $this->loadSettings('translation');

    $this->enabled = $settings['enabled'];
    $this->modules = $settings['modules'];
    $this->languages = $settings['languages'];
    $this->entity_types = $settings['entity_types'];
  }

  /**
   * Implements parent::process().
   */
  public function process() {
    // Only proceed if translations are enabled.
    if (!$this->enabled) {
      return;
    }

    // Enable translation modules.
    module_enable($this->modules);


    // Setup translation modules.
    foreach ($this->languages as $langcode) {
      locale_add_language($langcode);
    }

    $this->setupNegotiation();

    // Enable translations on menus
    db_update('menu_custom')
      ->fields(array(
        'i18n_mode' => 5,
      ))
      ->condition('menu_name', array('footer-menu', 'header-menu', 'main-menu'), 'IN')
      ->execute();

    // Enable translations on entity types.
    variable_set('entity_translation_entity_types', array_combine($this->entity_types, $this->entity_types));

    // Setup each node type.
    foreach (node_type_get_types() as $type => $info) {
      // Enable entity translation for each node type.
      variable_set('language_content_type_' . $type, 4);

      $this->entitySettings('node', $type);
    }

    // Setup bean types for translation.
    foreach (bean_get_types() as $type => $info) {
      $this->entitySettings('bean', $type);
    }

    // Setup taxonomy.
    foreach (taxonomy_vocabulary_get_names() as $vocab => $info) {
      $this->entitySettings('taxonomy_term', $vocab);
    }

    entity_info_cache_clear();
    menu_rebuild();
  }

  /**
   * Setup default language negotiation method.
   *
   * Sets the default detection method to path prefixes, e.g.
   * http://test.com/es/about will resolve to spanish version of about page.
   */
  protected function setupNegotiation () {
    variable_set("language_negotiation_language", array(
      'locale-url' => array(
        'callbacks' => array(
          'language' => 'locale_language_from_url',
          'switcher' => 'locale_language_switcher_url',
          'url_rewrite' => 'locale_language_url_rewrite_url',
        ),
        'file' => 'includes/locale.inc',
      ),
      'language-default' => array(
        'callbacks' => array(
          'language' => 'language_from_default',
        ),
      ),
    ));
    variable_set("language_negotiation_language_content", array(
      'locale-url' => array(
        'callbacks' => array(
          'language' => 'locale_language_from_url',
          'switcher' => 'locale_language_switcher_url',
          'url_rewrite' => 'locale_language_url_rewrite_url',
        ),
        'file' => 'includes/locale.inc',
      ),
      'locale-interface' => array(
        'callbacks' => array(
          'language' => 'locale_language_from_interface',
        ),
        'file' => 'includes/locale.inc',
      ),
      'language-default' => array(
        'callbacks' => array(
          'language' => 'language_from_default',
        ),
      ),
    ));
    variable_set("language_negotiation_language_url", array(
      'locale-url' => array(
        'callbacks' => array(
          'language' => 'locale_language_from_url',
          'switcher' => 'locale_language_switcher_url',
          'url_rewrite' => 'locale_language_url_rewrite_url',
        ),
        'file' => 'includes/locale.inc',
      ),
      'locale-url-fallback' => array(
        'callbacks' => array(
          'language' => 'locale_language_url_fallback',
        ),
        'file' => 'includes/locale.inc',
      ),
    ));
    variable_set("locale_language_negotiation_url_part", '0');
  }

  /**
   * Default settings for content entity translations.
   *
   * @param string $entity_type
   * @param string $bundle
   */
  protected function entitySettings($entity_type, $bundle) {
    variable_set('entity_translation_settings_' . $entity_type . '__' . $bundle, array (
      'default_language' => 'en',
      'hide_language_selector' => 1,
      'exclude_language_none' => 1,
      'lock_language' => 1,
      'shared_fields_original_only' => 1,
    ));
  }
}
