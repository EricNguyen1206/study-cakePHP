<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NotesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\NotesController Test Case
 *
 * @uses \App\Controller\NotesController
 */
class NotesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Notes',
        'app.Users',
    ];

    /**
     * Setup method to initialize the test environment
     */
    public function setUp()
    {
        parent::setUp();
        $this->session(['Auth.User' => ['id' => 1, 'username' => 'testuser']]);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        // Perform a GET request to the /notes URL
        $this->get('/notes');

        // Assert that the response status is 200 (OK)
        $this->assertResponseOk();

        // Assert that the view contains specific content
        $this->assertResponseContains('Notes');

        // Assert that some data is rendered in the table
        $this->assertResponseContains('First Note');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
