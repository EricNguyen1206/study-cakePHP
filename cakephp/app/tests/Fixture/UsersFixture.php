<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    public $import = ['table' => 'users'];

    public $records = [
        [
            'id' => 1,
            'username' => 'existinguser',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'created_at' => '2024-11-01 12:00:00'
        ]
    ];
}
