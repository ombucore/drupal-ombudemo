<?php

/**
 * @file
 * Settings dumper for OmnuCore.
 */

namespace OmbuCore\Settings;

use OmbuCore\Settings\Parser;
use Symfony\Component\Yaml\Dumper as YamlDumper;

class Dumper {
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
   * Settings parser.
   *
   * @param OmbuCore\Settings\Parser
   */
  protected $parser;

  /**
   * Yaml dumper.
   *
   * @param Symfony\Component\Yaml\Dumper
   */
  protected $dumper;

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

    $this->parser = new Parser($base_name, $profile);
    $this->dumper = new YamlDumper();
  }

  /**
   * Return destination config file for active profile.
   *
   * @param string
   *   The absolute path to destination config file.
   */
  public function getFilePath() {
    return drupal_get_path('profile', $this->profile) . '/config/' . $this->base_name . '.yml';
  }

  /**
   * Dump a yml config file to disk for the active profile.
   *
   * Using the base name for the default config file (e.g. modules.yml) and
   * a new settings array and writes a new overrides config file to profile,
   * with any additions, edits, and/or removals from the default configuration.
   *
   * @param array $settings
   *   A settings array to apply overrides to.
   */
  public function dump($settings) {
    $default_settings = $this->parser->parse(FALSE);

    $export_file_path = $this->getFilePath();

    // Make sure directory exists and is writable.
    file_prepare_directory(dirname($export_file_path), FILE_CREATE_DIRECTORY);

    $overrides = array();

    // Find any additions/edits in new settings.
    if ($additions = $this->findAdditions($default_settings, $settings)) {
      $overrides['add'] = $additions;
    }

    // Find any deletions.
    if ($deletions = $this->findDeletions($default_settings, $settings)) {
      $overrides['remove'] = $deletions;
    }

    if ($overrides) {
      $yaml = $this->dumper->dump($overrides, 5);
      file_put_contents($export_file_path, $yaml);
    }
  }

  /**
   * Finds any new keys/values within new settings array.
   *
   * @param array $default_settings
   *   Default settings array
   * @param array $new_settings
   *   New settings array
   *
   * @return array
   *   Unique values in new settings.
   */
  public function findAdditions($default_settings, $new_settings) {
    $normalize = FALSE;

    foreach ($new_settings as $key => $value) {
      if (is_array($value) && isset($default_settings[$key]) && is_array($default_settings[$key])) {
        $result = $this->findAdditions($default_settings[$key], $value);

        if (!empty($result)) {
          $new_settings[$key] = $result;
        }
        else {
          unset($new_settings[$key]);
        }
      }
      elseif (is_int($key)) {
        $normalize = TRUE;
        if (array_search($value, $default_settings) !== FALSE) {
          unset($new_settings[$key]);
        }
      }
      elseif ($value == $default_settings[$key]) {
        unset($new_settings[$key]);
      }
    }

    // If any keys are numeric, then normalize so YAML writes file correctly.
    if ($normalize) {
      sort($new_settings);
    }
    return $new_settings;
  }

  /**
   * Finds any removed keys/values within new settings array.
   *
   * @param array $default_settings
   *   Default settings array
   * @param array $new_settings
   *   New settings array
   *
   * @return array
   *   Unique values in new settings.
   */
  public function findDeletions($default_settings, $new_settings) {
    foreach ($default_settings as $key => $value) {
      if (is_array($value) && isset($new_settings[$key]) && is_array($new_settings[$key])) {
        $result = $this->findDeletions($value, $new_settings[$key]);

        if (!empty($result)) {
          $default_settings[$key] = $result;
        }
        else {
          unset($default_settings[$key]);
        }
      }
      elseif (is_int($key)) {
        $normalize = TRUE;
        if (array_search($value, $new_settings) !== FALSE) {
          unset($default_settings[$key]);
        }
      }
      elseif (isset($new_settings[$key])) {
        unset($default_settings[$key]);
      }
    }


    // If any keys are numeric, then normalize so YAML writes file correctly.
    if ($normalize) {
      sort($default_settings);
    }

    return $default_settings;
  }
}
