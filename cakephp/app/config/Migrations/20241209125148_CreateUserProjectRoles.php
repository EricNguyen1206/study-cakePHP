<?php

use Migrations\AbstractMigration;

class CreateUserProjectRoles extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('user_project_roles');
        $table->addColumn('user_id', 'integer', [
            'null' => false
        ])
            ->addColumn('project_id', 'integer', [
                'null' => false
            ])
            ->addColumn('role', 'enum', [
                'values' => ['project_manager', 'developer'],
                'null' => false
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('project_id', 'projects', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addIndex(['user_id', 'project_id'], ['unique' => true]) // Prevent duplicate user-project-role
            ->create();
    }

    public function down()
    {
        $this->dropTable('user_project_roles');
    }
}
