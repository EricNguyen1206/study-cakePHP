<?php

use Migrations\AbstractMigration;

class CreateProjects extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('projects');
        $table->addColumn('title', 'string', [
            'limit' => 255,
            'null' => false
        ])
            ->addColumn('description', 'text', [
                'null' => true
            ])
            ->addColumn('created_by', 'integer', [
                'null' => false
            ])
            ->addColumn('status', 'enum', [
                'values' => ['active', 'archived'],
                'default' => 'active',
                'null' => false
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addForeignKey('created_by', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('projects');
    }
}
