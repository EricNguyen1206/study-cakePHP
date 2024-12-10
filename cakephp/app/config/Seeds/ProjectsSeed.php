<?php

use Migrations\AbstractSeed;

class UserProjectSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1, // Ensure this user exists in the 'users' table
                'project_id' => 1, // Ensure this project exists in the 'projects' table
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2,
                'project_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('user_project');
        $table->insert($data)->save();
    }
}
