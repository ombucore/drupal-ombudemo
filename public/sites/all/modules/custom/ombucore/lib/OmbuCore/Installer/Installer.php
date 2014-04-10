<?php

/**
 * @file
 * Installer for base profile.
 */

namespace OmbuCore\Installer;

use OmbuCore\Task\TaskException;

class Installer {
  /**
   * List of available tasks.
   *
   * Key corresponds to object class the task belongs in.
   *
   * @var array
   */
  protected $tasks;

  /**
   * An array of information about the current installation state.
   *
   * @var array
   */
  protected $install_state;

  /**
   * Create installer and setup default tasks.
   *
   * @param array $install_state
   *   An array of information about the current installation state.
   */
  public function __construct($install_state) {
    $this->install_state = $install_state;
    $this->setupDefaultTasks();
  }

  /**
   * Setup default tasks.
   */
  protected function setupDefaultTasks() {
    $this->tasks = array(
      'PreSetup'     => 'Pre Setup',
      'Modules'      => 'Setup Modules',
      'Theme'        => 'Setup Themes',
      'ContentTypes' => 'Setup Content Types',
      'Variables'    => 'Setup Site Variables',
      'Taxonomy'     => 'Setup Taxonomy',
      'Menus'        => 'Setup Menus',
      'Blocks'       => 'Setup Blocks',
      'InputFormats' => 'Setup Input Formats',
      'Wysiwyg'      => 'Setup WYSIWYG',
      'Media'        => 'Setup Media',
      'Translation'  => 'Setup Translations',
      'Users'        => 'Setup Roles & Users',
      'AddContent'   => 'Add Content',
      'PostSetup'    => 'Post Setup',
    );
  }

  /**
   * Add a new task to the installer.
   *
   * @param string $class
   *   The class the task belongs to.
   * @param string $display_name
   *   The name to display during installation of this task.
   */
  public function addTask($class, $display_name) {
    $this->tasks[$class] = $display_name;
  }

  /**
   * Remove a task from the installer.
   *
   * @param string $class
   *   The class name of the task.
   */
  public function removeTask($class) {
    if (isset($this->tasks[$class])) {
      unset($this->tasks[$class]);
    }
  }

  /**
   * Proccess all available tasks.
   *
   * @return boolean
   *   TRUE on installation success.
   */
  public function processTasks() {
    try {
      foreach ($this->tasks as $task => $display_name) {
        $this->processTask($task);
      }
    }
    catch (InstallException $e) {
      $this->log('Error installing task: ' . $e->getMessage(), 'error');
    }
    catch (TaskException $e) {
      $this->log('Error executing task: ' . $e->getMessage(), 'error');
    }
  }

  /**
   * Process individual task.
   *
   * @param string $task_name
   *   The task name.
   */
  protected function processTask($task_name) {
    $task_class = $this->discoverTaskClass($task_name);

    $task = new $task_class($this->install_state);

    $this->log(sprintf('Executing task: %s', $this->tasks[$task_name]));

    $task->process();
  }

  /**
   * Discover appropriate class for task.
   *
   * Allow active profile to extend default tasks to alter settings and
   * processing by having the same class namespaces by the profile.
   *
   * @param string $task
   *   Task name
   *
   * @return string
   *   Fully namespaced class name for task.
   */
  protected function discoverTaskClass($task) {
    $class_list = array(
      // First check if active profile has task defined.
      $this->install_state['parameters']['profile'] . '\\Task\\' . $task,

      // Otherwise, check ombucore module.
      'OmbuCore\\Task\\' . $task,

      // Last chance, just check task name.
      $task,
    );

    foreach ($class_list as $class) {
      if (class_exists($class)) {
        $task_class = $class;
        break;
      }
    }

    if (empty($task_class)) {
      throw new InstallerException(sprintf('Unable to find task %s', array($task)));
    }

    return $task_class;
  }

  /**
   * Log things to drush_log, if available.
   *
   * @param string $message
   *   The message to log
   * @param string $type
   *   The type of log, e.g. 'error' or 'ok'. Defaults to 'ok'.
   */
  protected function log($message, $type = 'ok') {
    if (function_exists('drush_log')) {
      drush_log($message, $type);
    }
  }
}
