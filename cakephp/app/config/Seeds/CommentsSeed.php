<?php
use Migrations\AbstractSeed;

class CommentsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'content' => 'This is a great note!',
                'user_id' => 1,
                'note_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Needs more details.',
                'user_id' => 2,
                'note_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('comments');
        $table->insert($data)->save();
    }
}
