<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotesTable Test Case
 */
class NotesTableTest extends TestCase
{
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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Notes') ? [] : ['className' => NotesTable::class];
        $this->Notes = TableRegistry::getTableLocator()->get('Notes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Notes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $note = $this->Notes->newEntity([
            'user_id' => 1,
            'title' => 'Sample Note',
            'description' => 'This is a sample note.'
        ]);

        $this->assertEmpty($note->getErrors());
    }

    /**
     * Test validation when title is empty
     *
     * @return void
     */
    public function testValidationTitleEmpty()
    {
        $note = $this->Notes->newEntity([
            'user_id' => 1,
            'title' => null,
            'description' => 'This is a sample note.'
        ]);

        $errors = $note->getErrors();
        $this->assertNotEmpty($errors);
        $this->assertArrayHasKey('title', $errors);
        $this->assertEquals('This field cannot be left empty', $errors['title']['_empty']);
    }

    // Test to verify saving a note
    public function testSaveNote()
    {
        $note = $this->Notes->newEntity([
            'user_id' => 1,
            'title' => 'New Note',
            'description' => 'Description of the new note.'
        ]);

        $result = $this->Notes->save($note);
        $this->assertNotFalse($result);
    }
}
