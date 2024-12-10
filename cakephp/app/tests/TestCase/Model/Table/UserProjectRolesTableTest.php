<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserProjectTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserProjectTable Test Case
 */
class UserProjectTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserProjectTable
     */
    public $UserProject;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserProject',
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
        $config = TableRegistry::getTableLocator()->exists('UserProject') ? [] : ['className' => UserProjectTable::class];
        $this->UserProject = TableRegistry::getTableLocator()->get('UserProject', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserProject);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
