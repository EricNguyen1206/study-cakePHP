<?php

use Migrations\AbstractMigration;

class CreateUserProject extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('user_project');
        $table->addColumn('user_id', 'integer', [
            'null' => false
        ])
            ->addColumn('project_id', 'integer', [
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
            ->addIndex(['user_id', 'project_id'], ['unique' => true]) // Prevent duplicate user-project
            ->create();
    }

    public function down()
    {
        $this->dropTable('user_project');
    }
}
