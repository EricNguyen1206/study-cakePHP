<?php

use Migrations\AbstractSeed;

/**
 * Notes seed.
 */
class NotesSeed extends AbstractSeed
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
        $data = [];
        $userId = 1; // Assuming the user ID from the Users seed

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'user_id' => $userId,
                'title' => 'Sample Note ' . $i,
                'description' => 'This is the description for note ' . $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_active' => true,
                'image' => 'https://via.placeholder.com/600/8f209a',
            ];
        }

        $table = $this->table('notes');
        $table->insert($data)->save();
    }
}
