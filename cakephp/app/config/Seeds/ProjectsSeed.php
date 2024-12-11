<?php

use Migrations\AbstractSeed;

class UserProjectRolesSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1, // Ensure this user exists in the 'users' table
                'project_id' => 1, // Ensure this project exists in the 'projects' table
                'role' => 'project_manager',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2,
                'project_id' => 1,
                'role' => 'developer',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('user_project_roles');
        $table->insert($data)->save();
    }
}
