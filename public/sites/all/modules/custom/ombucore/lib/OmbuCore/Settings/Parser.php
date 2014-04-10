<?php

/**
 * @file
 * Settings parser for OmbuCore installer tasks.
 */

namespace OmbuCore\Settings;

use Symfony\Component\Yaml\Parser as YamlParser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Settings Parser
 *
 * Loads default yaml file from ombucore/config directory, then searches the
 * active profile for any overridden settings.
 *
 * Format for overriden settings in profile should be:
 *
 * @code
 *  - add:
 *    - Parent Key
 *      - New key: 'New Value'
 *      - Replace key: 'New Value'
 *  - remove:
 *    - Remove key
 * @endcode
 *
 * All keys in example should correspond to existing keys in parent yaml file
 * (with the exception of "New key").
 */
class Parser {
  /**
   * Base name of yaml file and override file.
   *
   * @param string
   */
  protected $base_name;

  /**
   * Name of the active profile.
   *
   * @param string
   */
  protected $profile;

  /**
   * Yaml parser.
   *
   * @param Symfony\Component\Yaml\Parser
   */
  protected $parser;

  /**
   * Constructor.
   *
   * @param string $base_name
   *   Base name of yaml file and override file.
   * @param string $profile
   *   Name of the active profile.
   */
  public function __construct($base_name, $profile) {
    $this->base_name = $base_name;
    $this->profile = $profile;

    $this->parser = new YamlParser();
  }

  /**
   * Parse config yaml file.
   *
   * @param bool $applyOverrides.
   *   Whether to apply overrides from active profile.
   *
   * @return array
   *   The final settings for given $base_name.
   */
  public function parse($applyOverrides = TRUE) {
    // Load up default settings.
    $config_file = $this->getFileName('module', 'ombucore');

    // If there are no default settings, then load up profile settings. This
    // could be the case if the profile exposes a new Task that requires
    // settings that's not in ombucore.
    if (!file_exists($config_file)) {
      $config_file = $this->getFileName('profile', $this->profile);

      // No config file found, return empty settings.
      if (!file_exists($config_file)) {
        return array();
      }

      // Parse yaml file. No need to apply overrides since no default yaml file
      // exists.
      $settings = $this->parser->parse(file_get_contents($config_file));
    }
    else {
      // Parse default yaml file.
      $settings = $this->parser->parse(file_get_contents($config_file));

      // Apply any overrides.
      if ($applyOverrides) {
        $this->applyOverrides($settings);
      }
    }

    return $settings;
  }

  /**
   * Apply any overrides present in profile config.
   *
   * @param array $settings
   *   Parsed settings file from default config.
   */
  protected function applyOverrides(&$settings) {
    $config_file = $this->getFileName('profile', $this->profile);

    if (file_exists($config_file)) {
      $overrides = $this->parser->parse(file_get_contents($config_file));

      // Check for malformed override config files.
      if (!isset($overrides['add']) && !isset($overrides['remove'])) {
        throw new ParseException('Profile config file should have `add` and/or `remove` keys in order to properly apply overrides');
      }

      if (isset($overrides['add'])) {
        $settings = $this->addSettings($settings, $overrides['add']);
      }

      if (isset($overrides['remove'])) {
        $settings = $this->removeSettings($settings, $overrides['remove']);
      }
    }
  }

  /**
   * Add values within a settings array.
   *
   * @param array $settings
   *   Settings array
   * @param array $overrides
   *   Overrides array
   *
   * @return array
   *   New settings array with all additions/edits from overrides.
   */
  protected function addSettings($settings, $overrides) {
    foreach ($overrides as $key => $value) {
      if (is_array($value) && isset($settings[$key]) && is_array($settings[$key])) {
        $settings[$key] = $this->addSettings($settings[$key], $value);
      }
      elseif (is_int($key) && !is_array($value)) {
        $settings[] = $value;
      }
      else {
        $settings[$key] = $value;
      }
    }

    return $settings;
  }

  /**
   * Remove values within a settings array.
   *
   * @param array $settings
   *   Settings array
   * @param array $overrides
   *   Overrides array
   *
   * @return array
   *   New settings array with all removals from overrides.
   */
  protected function removeSettings($settings, $overrides) {
    foreach ($overrides as $key => $value) {
      if (is_array($value) && isset($settings[$key]) && is_array($settings[$key])) {
        $settings[$key] = $this->removeSettings($settings[$key], $value);
      }
      elseif (is_int($key) && !is_array($value)) {
        unset($settings[array_search($value, $settings)]);
      }
      else{
        unset($settings[$key]);
      }
    }

    return $settings;
  }

  /**
   * Returns corresponding yaml file for base name for a module or profile.
   *
   * @param string $type
   *   Type of item to pass to drupal_get_path(). Could be 'module' or
   *   'profile'.
   * @param string $name
   *   The name of the item.
   *
   * @return string
   *   Path to yaml file.
   */
  protected function getFileName($type, $name) {
    return drupal_get_path($type, $name) . '/config/' . $this->base_name . '.yml';
  }
}
