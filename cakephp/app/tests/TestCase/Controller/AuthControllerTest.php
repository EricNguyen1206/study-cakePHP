<?php

namespace App\Test\TestCase\Controller;

use App\Controller\AuthController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class AuthControllerTest extends TestCase
{
  use IntegrationTestTrait;

  // Load fixture nếu cần
  public $fixtures = ['app.Users'];

  public function setUp()
  {
    parent::setUp();
    $this->enableCsrfToken();
    $this->enableSecurityToken();
  }

  // Test action login
  public function testLogin()
  {
    $this->post('/auth/login', [
      'username' => 'manager_user',
      'password' => 'password123'
    ]);

    $this->assertRedirect('/projects');
  }

  public function testLoginWithInvalidCredentials()
  {
    $this->post('/auth/login', [
      'username' => 'wrong_user',
      'password' => 'wrong_password'
    ]);

    $this->assertResponseContains('Invalid username or password');
    $this->assertNoRedirect();
  }

  // Test action register
  public function testRegister()
  {
    $this->post('/auth/register', [
      'username' => 'new_user',
      'email' => 'new_user@example.com',
      'password' => 'password123',
      'role' => 'manager'
    ]);

    $this->assertRedirect('/auth/login');
  }

  // Test action logout
  public function testLogout()
  {
    // Login first
    $this->session(['Auth.User' => ['id' => 1, 'username' => 'manager_user']]);

    $this->get('/auth/logout');

    $this->assertRedirect('/auth/login');
    $this->assertSession(null, 'Auth.User');
  }
}
