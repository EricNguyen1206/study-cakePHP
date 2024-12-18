<?php

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ProjectUsersController Test Case
 *
 * @uses \App\Controller\ProjectUsersController
 */
class ProjectUsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProjectUsers',
        'app.Users',
        'app.Projects',
    ];

    public function testIndex()
    {
        $this->get('/project-users'); // Adjust the URL as necessary
        $this->assertResponseOk(); // Check if the response is 200 OK
        $this->assertResponseContains('Project Users'); // Check if the response contains expected text
    }
}
