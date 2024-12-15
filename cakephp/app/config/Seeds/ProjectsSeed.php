<?php

use Migrations\AbstractSeed;

class ProjectsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'title' => 'Project Alpha',
                'description' => 'This is the first project.',
                'created_by' => 1, // Assuming user ID 1 exists
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Project Beta',
                'description' => 'Second project description.',
                'created_by' => 1,
                'status' => 'archived',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('projects');
        $table->insert($data)->save();
    }
}
