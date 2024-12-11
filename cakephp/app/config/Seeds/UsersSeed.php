<?php

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'project_manager',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'dev_user',
                'email' => 'dev@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'developer',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
