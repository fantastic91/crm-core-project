<?php
/**
 * @file
 * Contains Drupal\crm_core_project\Entity\Project.
 */

namespace Drupal\crm_core_project\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldDefinition;

/**
 * CRM Project Entity Class.
 *
 * @ContentEntityType(
 *   id = "crm_core_project",
 *   label = @Translation("CRM Core Project"),
 *   handlers = {
 *     "list_builder" = "Drupal\crm_core_project\ProjectListBuilder",
 *     "form" = {
 *       "default" = "Drupal\crm_core_project\Form\ProjectForm",
 *       "delete" = "Drupal\crm_core_project\Form\DeleteForm"
 *     },
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData"
 *   },
 *   base_table = "crm_core_project",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "project_id",
 *     "uuid" = "uuid",
 *     "label" = "title",
 *   },
 *   admin_permission = "administer projects",
 *   links = {
 *     "canonical" = "/admin/content/project/{crm_core_project}",
 *     "delete-form" = "/admin/content/project/{crm_core_project}/delete",
 *     "edit-form" = "/admin/content/project/{crm_core_project}/edit",
 *   }
 * )
 */
class Project extends ContentEntityBase {
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = array();

    $fields['project_id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Project ID'))
      ->setDescription(t('The project ID.'))
      ->setReadOnly(TRUE)
      ->setSetting('unsigned', TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The node UUID.'))
      ->setReadOnly(TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of this project.'))
      ->setRequired(TRUE)
      ->setRevisionable(TRUE)
      ->setSetting('default_value', '')
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE);

    return $fields;
  }
}
