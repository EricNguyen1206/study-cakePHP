<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectUsersTable Test Case
 */
class ProjectUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectUsersTable
     */
    public $ProjectUsers;

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

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProjectUsers') ? [] : ['className' => ProjectUsersTable::class];
        $this->ProjectUsers = TableRegistry::getTableLocator()->get('ProjectUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectUsers);

        parent::tearDown();
    }

    public function testInitialize()
    {
        $this->ProjectUsers->initialize([]);
        $this->assertEquals('ProjectUsers', $this->ProjectUsers->getTable()); // Check if the table name is correct
        $this->assertEquals('id', $this->ProjectUsers->getPrimaryKey()); // Check if the primary key is correct
        $this->assertEquals('created', $this->ProjectUsers->getTimestamp()); // Check if the timestamp field is correct
    }
}
