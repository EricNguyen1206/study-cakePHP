<?php

use Migrations\AbstractSeed;

class VotesSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'post_id' => 1, // Ensure post with ID 1 exists
                'user_id' => 1, // Ensure user with ID 1 exists
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'post_id' => 1,
                'user_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'post_id' => 2,
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('votes');
        $table->insert($data)->save();
    }
}
