<?php

namespace App\Test\TestCase\Controller;

use App\Controller\ProjectsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ProjectsController Test Case
 *
 * @uses \App\Controller\ProjectsController
 */
class ProjectsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    // Load fixture
    public $fixtures = ['app.Projects', 'app.Users'];

    public function setUp()
    {
        parent::setUp();
        $this->enableCsrfToken();
        $this->enableSecurityToken();
    }

    // Test add action with manager role
    public function testAddProjectAsManager()
    {
        // Giả lập user login với quyền manager
        $this->session(['Auth.User' => ['id' => 1, 'username' => 'manager_user', 'role' => 'manager']]);

        $this->post('/projects/add', [
            'title' => 'New Project',
            'description' => 'This is a test project'
        ]);

        $this->assertRedirect('/projects');
        $this->assertResponseContains('The project has been saved');

        $this->assertEventFired('Model.afterSave');
    }

    // Test add action without manager role
    public function testAddProjectAsDeveloper()
    {
        // Giả lập user login với quyền developer
        $this->session(['Auth.User' => ['id' => 2, 'username' => 'dev_user', 'role' => 'developer']]);

        $this->post('/projects/add', [
            'title' => 'Unauthorized Project',
            'description' => 'Should not work'
        ]);

        $this->assertRedirect('/projects');
        $this->assertResponseContains('You are not authorized to add a project');
    }

    // Test add action without login
    public function testAddProjectWithoutLogin()
    {
        $this->post('/projects/add', [
            'title' => 'New Project',
            'description' => 'This is a test project'
        ]);

        $this->assertRedirect('/auth/login');
    }
}
