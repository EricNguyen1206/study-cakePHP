<?php

namespace App\Test\Fixture;

use App\Enum\RoleEnum;
use Cake\TestSuite\Fixture\TestFixture;

class UsersFixture extends TestFixture
{
    public $import = ['table' => 'users'];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'username' => 'manager_user',
                'email' => 'manager@example.com',
                'password' => '$2y$10$e0VbPHKoO2OoNQ9OPB0Nauq2QsLW7iq/UeU1D6hV1EFYPA1s21sXK', // password123
                'role' => RoleEnum::MANAGER,
                'created_at' => '2024-01-01 00:00:00'
            ],
            [
                'id' => 2,
                'username' => 'dev_user',
                'email' => 'dev@example.com',
                'password' => '$2y$10$e0VbPHKoO2OoNQ9OPB0Nauq2QsLW7iq/UeU1D6hV1EFYPA1s21sXK', // password123
                'role' => RoleEnum::DEVELOPER,
                'created_at' => '2024-01-01 00:00:00'
            ]
        ];
        parent::init();
    }
}
