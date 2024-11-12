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
     * Test initialize method
     *
     * @return void
     */
    // public function testInitialize()
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        // $this->markTestIncomplete('Not implemented yet.');
        $note = $this->Notes->newEntity([
            'user_id' => 1,
            'title' => 'Sample Note',
            'description' => 'This is a sample note.'
        ]);

        $this->assertEmpty($note->getErrors());
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    // public function testBuildRules()
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

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
