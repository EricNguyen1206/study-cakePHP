<?php

use PHPUnit\Framework\TestCase;
use App\Model\Entity\User;
use App\Model\Table\UsersTable;

class UserTest extends TestCase
{
  protected $user;

  protected function setUp()
  {
    // Set up a new User instance for testing
    $this->user = new UsersTable();
  }

  public function testCanCreateUser()
  {
    $this->user->username = 'testuser';
    $this->user->email = 'test@example.com';
    $this->user->password = password_hash('password123', PASSWORD_BCRYPT);
    $this->assertTrue($this->user->save());

    $this->assertNotNull($this->user->id);
  }

  public function testPasswordIsHashed()
  {
    $password = 'password123';
    $this->user->password = password_hash($password, PASSWORD_BCRYPT);

    $this->assertNotEquals($password, $this->user->password);
    $this->assertTrue(password_verify($password, $this->user->password));
  }

  public function testCanRetrieveUserByEmail()
  {
    $user = UsersTable::where('email', 'test@example.com')->first();
    $this->assertEquals('test@example.com', $user->email);
  }

  protected function tearDown(): void
  {
    // Clean up after each test
    User::where('email', 'test@example.com')->delete();
  }
}
