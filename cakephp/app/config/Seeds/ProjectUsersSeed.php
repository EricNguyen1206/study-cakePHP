<?php

use Migrations\AbstractSeed;

/**
 * ProjectUsers seed.
 */
class ProjectUsersSeed extends AbstractSeed
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
                'user_id' => 1,
                'project_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'project_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        $table = $this->table('project_users');
        $table->insert($data)->save();
    }
}
