<?php

/**
 * @file
 * Contains \Drupal\crm_core_project\Form\DeleteForm.
 */

namespace Drupal\crm_core_project\Form;

use Drupal\Core\Entity\ContentEntityDeleteForm;
use Drupal\Core\Url;

/**
 * Provides the delete form for projects.
 */
class DeleteForm extends ContentEntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete project %title?', array(
      '%title' => $this->entity->label(),
    ));
  }

  /**
   * Returns the message to display to the user after deleting the entity.
   *
   * @return string
   *   The translated string of the deletion message.
   */
  public function getDeletionMessage() {
    $entity = $this->getEntity();
    return $this->t('The project %label has been deleted.', array(
      '%label' => $entity->label(),
    ));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('view.projects.page_1');
  }
}
