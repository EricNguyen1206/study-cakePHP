<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NotesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\NotesController Test Case
 *
 * @uses \App\Controller\NotesController
 */
class NotesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotesTable
     */
    public $Notes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Notes',
        'app.Users',
    ];
    public $autoFixtures = true;

    /**
     * Setup method to initialize the test environment
     */
    public function setUp()
    {
        parent::setUp();
        // Load the Notes table
        $this->Notes = TableRegistry::getTableLocator()->get('Notes');

        // Disable CSRF protection for tests
        $this->enableCsrfToken();
    }

    public function testIndex()
    {
        // Simulate a GET request to the index method
        $this->get('/notes/index');

        // Check that the response is successful
        $this->assertResponseSuccess();
        // Check that the view contains the notes
        $this->assertResponseContains('Notes');
    }

    public function testAdd()
    {
        // Simulate a POST request to add a note
        $data = [
            'title' => 'Test Note',
            'description' => 'This is a test note description.'
        ];
        $this->post('/notes/add', $data);

        // Check that the note was saved
        $this->assertResponseSuccess();
        $this->assertRedirect(['action' => 'index']);
        
        // Verify the note is in the database
        $query = $this->Notes->find()->where(['title' => 'Test Note']);
        $this->assertEquals(1, $query->count());
    }

    public function testEdit()
    {
        // First, create a note to edit
        $note = $this->Notes->newEntity([
            'title' => 'Original Title',
            'description' => 'Original description.'
        ]);
        $this->Notes->save($note);

        // Simulate a POST request to edit the note
        $data = [
            'title' => 'Updated Title',
            'description' => 'Updated description.'
        ];
        $this->put('/notes/edit/' . $note->id, $data);

        // Check that the response is successful
        $this->assertResponseSuccess();
        $this->assertRedirect(['action' => 'index']);
        
        // Verify the note was updated in the database
        $updatedNote = $this->Notes->get($note->id);
        $this->assertEquals('Updated Title', $updatedNote->title);
    }

    public function testDelete()
    {
        // First, create a note to delete
        $note = $this->Notes->newEntity([
            'title' => 'Note to be deleted',
            'description' => 'This note will be deleted.'
        ]);
        $this->Notes->save($note);

        // Verify note exists before deletion
        $this->assertNotNull($this->Notes->get($note->id));

        // Simulate a DELETE request to delete the note
        $this->post('/notes/delete/' . $note->id);

        // Check that the response is successful and redirects to index
        $this->assertResponseSuccess();
        $this->assertRedirect(['action' => 'index']);
        
        // Verify the note is no longer in the database
        $this->expectException(\Cake\Datasource\Exception\RecordNotFoundException::class);
        $this->Notes->get($note->id);
    }
}