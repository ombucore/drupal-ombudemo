<?php

/**
 * @file
 * Enables default modules for a site install.
 */

namespace OmbuCore\Task;

class Modules extends Task {
  /**
   * @var array
   * Array of modules to enable.
   */
  protected $modules;

  /**
   * Provide a list of default modules most sites need.
   */
  public function settings() {
    $this->modules = $this->loadSettings('modules');
  }

  /**
   * Enable all modules.
   */
  public function process() {
    if (!module_enable($this->modules)) {
      // If module enable fails, that means a module is missing.  Give a useful
      // error message to site installer.
      $module_data = system_rebuild_module_data();

      // Add dependencies to module list.
      foreach ($module_data as $module => $data) {
        if (in_array($module, $this->modules)) {
          foreach (array_keys($data->requires) as $dependency) {
            $this->modules[] = $dependency;
          }
        }
      }
      $this->modules = array_unique($this->modules);

      $missing_modules = array();
      foreach ($this->modules as $module) {
        if (!isset($module_data[$module])) {
          $missing_modules[] = $module;
        }
      }

      if ($missing_modules) {
        $string = format_plural(count($missing_modules), 'Missing module: !module', 'Missing modules: !module', array(
          '!module' => implode(' ', $missing_modules),
        ));
        throw new TaskException($string);
      }
    }

    // Disable update module. The Drupal installer will run cron after
    // installation is complete, which will in turn run update_cron(), which
    // sends a mail to the admin with available updates. This breaks deployments
    // on servers with sendmail disabled, and we don't want to expose update
    // warnings to client sites anyway.
    module_disable(array('update'));

    // Flush caches so feature fields are fully built and entities behave.
    drupal_flush_all_caches();
    db_truncate('cache');
    drupal_get_complete_schema(TRUE);

    if (module_exists('entity')) {
      entity_flush_caches();
      drupal_static_reset('entity_get_controller');
    }

    // Rebuild all features.
    if (module_exists('features') && function_exists('drush_invoke_process')) {
      drush_log(dt('Reverting features'), 'ok');
      drush_invoke_process('', 'features-revert-all', array(), array('-y'));
    }

    // Revert default apachesolr environment.
    if (module_exists('apachesolr')) {
      $this->revertSolr();
    }
  }

  /**
   * Revert default apachesolr environment.
   *
   * There's a bug in apachesolr where the environment overrides in code don't
   * get picked up until it is reverted, so this code attempts to revert the
   * environment on build.
   */
  protected function revertSolr() {
    apachesolr_environment_delete('solr');
  }
}
