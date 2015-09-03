<?php

/**
 * @file
 * Contains \Drupal\crm_core_project\Form\ProjectForm.
 */

namespace Drupal\crm_core_project\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the project forms.
 */
class ProjectForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = $this->t('Save project');
    return $actions;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $status = $entity->save();
    if ($status == SAVED_UPDATED) {
      drupal_set_message(t('The project %label has been updated.', array(
        '%label' => $entity->label(),
      )));
    }
    elseif ($status == SAVED_NEW) {
      drupal_set_message(t('The project %label has been added.', array(
        '%label' => $entity->label(),
      )));
    }
    return $this->entity->save();
  }
}
