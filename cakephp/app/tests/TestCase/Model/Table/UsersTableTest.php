<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = TableRegistry::getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $user = $this->Users->newEntity([
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $this->assertEmpty($user->getErrors());
    }

    // Test to verify saving a user
    public function testSaveUser()
    {
        $user = $this->Users->newEntity([
            'username' => 'newuser',
            'email' => 'newuser@example.com',
            'password' => 'password123'
        ]);

        $result = $this->Users->save($user);
        $this->assertNotFalse($result);
    }
}
