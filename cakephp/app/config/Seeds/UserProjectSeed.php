<?php

use Migrations\AbstractSeed;

/**
 * UserProject seed.
 */
class UserProjectSeed extends AbstractSeed
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

        $table = $this->table('user_project');
        $table->insert($data)->save();
    }
}
