<?php

use Migrations\AbstractSeed;

/**
 * Comments seed.
 */
class CommentsSeed extends AbstractSeed
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
                'note_id' => 1, // Ensure a note with ID 1 exists
                'user_id' => 1, // Ensure a user with ID 1 exists
                'content' => 'This is the first comment.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'note_id' => 1,
                'user_id' => 2,
                'content' => 'This is the second comment.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'note_id' => 2,
                'user_id' => 1,
                'content' => 'Another comment on a different note.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('comments');
        $table->insert($data)->save();
    }
}
