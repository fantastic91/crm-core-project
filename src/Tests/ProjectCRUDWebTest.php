<?php

  /**
   * @file
   * Contains \Drupal\crm_core_project\Tests\ProjectCRUDWebTest.
   */

namespace Drupal\crm_core_project\Tests;

use Drupal\crm_core_project\Entity\Project;
use Drupal\simpletest\WebTestBase;

/**
 * Tests the UI for Project CRUD operations.
 *
 * @group crm_core
 */
class ProjectCRUDWebTest extends WebTestBase {
  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array(
    'crm_core_project',
    'views',
  );

  /**
   * Test basic UI operations with Projects.
   *
   * Create a project.
   * Edit every project. Assert projects changed from listing page.
   * Delete every project. Assert they disappeared from listing page.
   */
  public function testProjectOperations() {
    // Create and login user. User should be able to create projects.
    $user = $this->drupalCreateUser(array(
      'administer projects',
      'add projects',
    ));
    $this->drupalLogin($user);

    // Add a project. Ensure it is listed.
    $this->drupalGet('admin/content/project');
    $this->assertLink(t('Add project'));
    $this->clickLink(t('Add project'));
    $project_form = array(
      'title[0][value]' => 'iTest',
    );
    $this->drupalPostForm('admin/content/project/add', $project_form, 'Save project');
    $this->assertText('The project iTest has been added.');
    $this->drupalGet('admin/content/project');
    $this->assertLink(t('iTest'));

    // Update project and assert its title changed on the list.
    $project_form = array(
      'title[0][value]' => 'Cherry',
    );
    $this->drupalPostForm('admin/content/project/1/edit', $project_form, 'Save project');
    $this->assertText('The project Cherry has been updated.');
    $this->drupalGet('admin/content/project');
    $this->assertLink(t('Cherry'));

    // Delete project.
    $this->drupalPostForm('admin/content/project/1/delete', array(), 'Delete');
    $this->assertText('The project Cherry has been deleted.');
    $this->drupalGet('admin/content/project');
    $this->assertNoLink('Cherry', 'Deleted project is no more listed.');

    // Assert there is no projects left.
    $this->drupalGet('admin/content/project');
    $this->assertText(t('No projects available.'), 'No projects listed.');
  }
}
