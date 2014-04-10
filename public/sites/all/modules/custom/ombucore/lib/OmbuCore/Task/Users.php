<?php
/**
 * @file
 * Setup user roles and permissions.
 */

namespace OmbuCore\Task;

class Users extends Task {
  /**
   * Roles and permissions
   *
   * @var array
   */
  protected $roles = array();

  /**
   * Create test users.
   *
   * @var boolean
   */
  protected $create_test_users;

  /**
   * Get default roles and permissions.
   */
  public function settings() {
    $this->roles = $this->getUserRoleSettings();

    $this->create_test_users = TRUE;
  }

  /**
   * Save roles and create test users.
   */
  public function process() {
    $this->saveRolesPermissions();

    // Create a test user for each role.
    if ($this->create_test_users) {
      $this->createTestUsers();
    }
  }

  /**
   * Save all roles and permissions.
   */
  protected function saveRolesPermissions() {
    // Reset Bean caches so the correct perms are available.
    if (function_exists('bean_reset')) {
      bean_reset();
      drupal_static_reset('bean_get_types');
    }

    $weight = 0;
    foreach ($this->roles as $role_name => $perms) {
      // Attempt to load existing role.
      $role = user_role_load_by_name($role_name);
      if ($role === FALSE) {
        $role = new \stdClass();
        $role->name = $role_name;
      }
      $role->weight = ++$weight;

      user_role_save($role);

      user_role_grant_permissions($role->rid, $perms);
    }

    // Assign user 1 the "administrator" role.
    $roles = array_flip(user_roles());
    db_insert('users_roles')
      ->fields(array('uid' => 1, 'rid' => $roles['admin']))
      ->execute();
  }

  /**
   * Create test users for each role.
   */
  protected function createTestUsers() {
    $roles = user_roles();
    foreach ($roles as $rid => $role_name) {
      if (in_array($role_name, array('anonymous user', 'authenticated user'))) {
        continue;
      }

      $user_roles = array(
        $rid => $role_name,
      );

      // Grant admin all roles.
      if ($role_name == 'admin') {
        $user_roles = $roles;
      }

      $slug = str_replace(' ', '_', $role_name);
      $user = array(
        'name' => 'test_' . $slug,
        'pass' => 'pass',
        'mail' => 'test_' . $slug . '@ombuweb.com',
        'status' => 1,
        'roles' => $user_roles,
      );
      $user = user_save(new \stdClass(), $user);

      // Grand access section to editor role.
      if ($role_name != 'admin') {
        $this->grantAccessSection($user);
      }
    }
  }

  /**
   * Grant random access section to user.
   */
  protected function grantAccessSection($user) {
    // Only proceed if workbench suite is enabled.
    if (!module_exists('ombubench')) {
      return;
    }

    // Get a random term from the workbench vocabulary
    $vocab = variable_get('workbench_access_taxonomy', array());
    $vocab = array_filter($vocab);
    if ($vocab) {
      $vocab = taxonomy_vocabulary_machine_name_load(current($vocab));
      $tree = taxonomy_get_tree($vocab->vid);
      $term = $tree[array_rand($tree)];
    }

    workbench_access_user_section_save($user->uid, $term->tid, 'taxonomy');
  }

  /**
   * Load up default user/role settings.
   */
  protected function getUserRoleSettings() {
    return $this->loadSettings('roles');
  }
}
