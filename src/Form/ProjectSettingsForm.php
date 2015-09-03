<?php

  /**
   * @file
   * Contains \Drupal\crm_core_project\Form\ProjectSettingsForm.
   */

namespace Drupal\crm_core_project\Form;

use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure project settings.
 */
class ProjectSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'crm_core_project_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['crm_core_project.settings'];
  }
}
