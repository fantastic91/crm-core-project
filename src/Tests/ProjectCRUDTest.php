<?php
/**
 * @file
 * Contains \Drupal\crm_core_project\Tests\ProjectCRUDTest.
 */

namespace Drupal\crm_core_project\Tests;

use Drupal\crm_core_project\Entity\Project;
use Drupal\simpletest\KernelTestBase;

/**
 * Tests CRUD operations for the CRM Core Project entity.
 *
 * @group crm_core
 */
class ProjectCRUDTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array(
    'crm_core',
    'crm_core_project',
  );

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installEntitySchema('crm_core_project');
  }

  /**
   * Tests CRUD of projects.
   */
  public function testProject() {

    // Create.
    $project = Project::create(array('title' => 'CRM Project'));
    $this->assertEqual(SAVED_NEW, $project->save(), 'Project saved.');

    // Load.
    $project_load = Project::load($project->id());
    $uuid = $project_load->uuid();
    $this->assertTrue(!empty($uuid), 'Loaded project has uuid.');
    $title = $project_load->label();
    $this->assertTrue(!empty($title), 'Loaded project has title.');

    // Delete.
    $project->delete();
    $project_load = Project::load($project->id());
    $this->assertNull($project_load, 'Project deleted.');
  }
}
