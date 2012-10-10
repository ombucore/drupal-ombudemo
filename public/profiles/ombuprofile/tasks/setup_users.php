<?php
// $Id$

/**
 * Setup user roles and permissions.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_setup_users($install_state) {

  // Reset Bean caches so the correct perms are available
  if (function_exists('bean_reset')) {
    bean_reset();
    drupal_static_reset('bean_get_types');
  }


  /**
   * User settings (admin/config/people/accounts)
   */

  // Set default contact status (gets added to the users data field)
  variable_set('contact_default_status', 0);

  /**
   * Registration settings:
   *  0 - Only site admins can create new accounts
   *  1 - Visitors can create accounts without admin approval
   *  2 - Visitors can create accounts with admin approval
   */
  variable_set('user_register', 0);

  // Require email varification when a visitor creates an account
  variable_set('user_email_verification', 0);

  ombuprofile_load_roles_and_perms_from_dump();

  $roles = array_flip(user_roles());

  // Create a test user for each role
  foreach ($roles as $role_name => $rid) {
    if (in_array($role_name, array('anonymous user', 'authenticated user'))) {
      continue;
    }
    $slug = str_replace(' ', '_', $role_name);
    $user = array(
      'name' => 'test_'. $slug,
      'pass' => 'pass',
      'mail' => 'test_'. $slug .'@ombuweb.com',
      'status' => 1,
        'roles' => array(
          $rid => $role_name,
        ),
    );
    user_save(new stdClass, $user);
  }

  // Assign user 1 the "administrator" role.
  db_insert('users_roles')
    ->fields(array('uid' => 1, 'rid' => $roles['admin']))
    ->execute();
}

/**
 * User roles and permissions.
 *
 * Load the roles & permissions from the ombuprofile.roles.inc file generated
 * by the `$ drush dump-roles-perms` command exposed by the base module
 */
function ombuprofile_load_roles_and_perms_from_dump() {
  require(drupal_get_path('profile', 'ombuprofile') .'/ombuprofile.roles.inc');
  $weight = 0;
  foreach ($roles_perms as $role_name => $perms) {
    $role = user_role_load_by_name($role_name);
    if ($role === FALSE) {
      $role = new stdClass();
      $role->name = $role_name;
    }
    $role->weight = $weight;
    user_role_save($role);
    user_role_grant_permissions($role->rid, $perms);
    $weight++;
  }
}

