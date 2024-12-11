<?php
use Migrations\AbstractSeed;

/**
 * UserProjectRoles seed.
 */
class UserProjectRolesSeed extends AbstractSeed
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

        $table = $this->table('user_project_roles');
        $table->insert($data)->save();
    }
}
