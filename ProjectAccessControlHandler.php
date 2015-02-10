<?php

/**
 * @file
 * Contains \Drupal\crm_core_project\ProjectAccessControlHandler.
 */

namespace Drupal\crm_core_project;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Class ProjectAccessController.
 */
class ProjectAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    $administer_project = $account->hasPermission('administer crm_core_project entities');

    switch ($operation) {
      case 'view':
        $view_any_project = $account->hasPermission('view any crm_core_project entity');

        return ($administer_project || $view_any_project);

      case 'update':
        $edit_any_project = $account->hasPermission('edit any crm_core_project entity');

        return ($administer_project || $edit_any_project);

      case 'delete':
        $delete_any_project = $account->hasPermission('delete any crm_core_project entity');

        return ($administer_project || $delete_any_project);

      case 'revert':
        // @todo: more fine grained will be adjusting dynamic permission
        // generation for reverting bundles of project.
        $revert_any_project = $account->hasPermission('revert project record');

        return ($administer_project || $revert_any_project);

      // @todo This operation should be renamed or even deleted(because we have ContactAccessControlHandler::checkCreateAccess()).
      case 'create_view':
        // Any of the create permissions.
        $create_any_project = $account->hasPermission('create crm_core_project entities');
        return ($administer_project || $create_any_project);
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {

    $administer_project = $account->hasPermission('administer crm_core_project entities');

    // Must be able to create project of any type (OR) specific type
    // (AND) have an active project type.
    // IMPORTANT, here $contact is padded in as a string of the contact type.
    $create_any_project = $account->hasPermission('create crm_core_project entities');
   // $create_type_contact = $account->hasPermission('create crm_core_project entities of bundle ' . $entity_bundle);

    $contact_type_is_active = empty($entity_bundle);

    // Load the contact type entity.
//    if (!empty($entity_bundle)) {
//      /* @var \Drupal\crm_core_project\Entity\ContactType $contact_type_entity */
//      $contact_type_entity = ContactType::load($entity_bundle);
//      $contact_type_is_active = $contact_type_entity->status();
//    }

    return ($administer_project || $create_any_project);
  }
}
