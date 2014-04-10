<?php

/**
 * @file
 * Post setup tasks.
 *
 * Any tasks that require all other settings and content to be defined.
 */

namespace OmbuCore\Task;

class PostSetup extends Task {
  /**
   * Implements parent::process().
   */
  public function process() {
    // Set proper workbench access control schemas and user sections. This needs
    // to happen outside of ombubench.install because it needs to respond to
    // Taxonomy::process() and User::process tasks during the installation
    // process.
    if (module_exists('ombubench')) {
      $active = workbench_access_get_active_tree();
      foreach ($active['tree'] as $item) {
        $data = array_merge($active['access_scheme'], $item);

        $existing = db_query("SELECT access_id FROM {workbench_access} WHERE access_id = :access_id AND access_scheme = :access_scheme", array(
          ':access_id' => $data['access_id'],
          ':access_scheme' => $data['access_scheme'],
        ))->fetchAssoc();
        if (!$existing) {
          workbench_access_section_save($data);
        }
      }

      // Add editor role to publisher user.
      $account = user_load_by_name('test_publisher');
      $pub_role = ombubench_get_publisher_role();
      $editor_role = ombubench_get_editor_role();
      $account->roles[$pub_role->rid] = $pub_role->name;
      $account->roles[$editor_role->rid] = $editor_role->name;
      user_save($account);

      // Make sure publisher gets proper access section.
      $term = taxonomy_get_term_by_name('Administrators only');
      $term = current($term);

      if (isset($term->term)) {
        $existing = db_query("SELECT access_id FROM {workbench_access_user} WHERE uid = :uid AND access_id = :access_id AND access_scheme = 'taxonomy'", array(
          ':uid' => $account->uid,
          ':access_id' => $term->tid,
        ))->fetchAssoc();
        if (!$existing) {
          workbench_access_user_section_save($account->uid, $term->tid, 'taxonomy');
        }
      }

      // Disable workbench views.
      $views_status = variable_get('views_defaults', array());
      $views_status['workbench_moderation'] = TRUE;
      $views_status['workbench_access_content'] = TRUE;
      variable_set('views_defaults', $views_status);
      views_invalidate_cache();
    }
  }
}
