Base Profile
============

Provides default configuration for OMBU profile installations.

Setup
-----

To use the base installer and default tasks, use the following code in the
profile `hook_install_tasks` task function:

    $loader = ombucore_autoload();
    $installer = new OmbuCore\Installer\Installer($install_state);
    $installer->processTasks();

Configuration
-------------

All configuration files for each installation task are found within the
`config/` directory as `yaml` files. To override any task configuration, copy
the configuration file into a `config/` directory within the profile.

Adding/Removing Tasks
---------------------

Tasks can be added using the following code, called before `processTasks()` (if
the class is namespaced to the current profile, follow autoloading instructions
in next section):

    $installer->addTask('TaskClassName', 'Task display name');

Tasks can be remove as well:

    $installer->removeTask('TaskClassName');

Extending Tasks
---------------

If a task requires custom processing, it can be extended. To so, create a new
class namespaced by the profile name. For example, for a profile named
`ombuprofile`, to make a custom `Blocks` task (e.g. to create bean objects),
create a new file at `lib/ombuprofile/Task/Blocks.php` that looks like:

    <?php

    namespace ombuprofile\Task;

    class Blocks extends \OmbuCore\Task\Blocks {
      public function process() {
        parent::process();

        // Custom code here.
      }
    }

And change the installer code to the following to setup proper autoloading for
the profile:

    $loader = ombucore_autoload();
    $loader->add('ombuprofile', DRUPAL_ROOT . '/' . drupal_get_path('profile', 'ombuprofile') . '/lib');
    $installer = new OmbuCore\Installer\Installer($install_state);
    $installer->processTasks();
