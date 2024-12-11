<?php

use Migrations\AbstractSeed;

class PostsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'project_id' => 1, // Ensure this project exists
                'created_by' => 1, // Ensure this user exists
                'title' => 'First Post',
                'description' => 'This is the first post in the project.',
                'image' => '/uploads/default.jpg',
                'is_deleted' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'project_id' => 2,
                'created_by' => 2,
                'title' => 'Second Post',
                'description' => 'This is another project post.',
                'image' => null,
                'is_deleted' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('posts');
        $table->insert($data)->save();
    }
}
