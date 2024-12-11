<?php

use Migrations\AbstractMigration;

class UpdateNotesToPosts extends AbstractMigration
{
    public function change()
    {
        // Rename the table
        $this->table('notes')->rename('posts')->update();

        // Modify columns and add new ones
        $table = $this->table('posts');
        $table->addColumn('project_id', 'integer', [
            'null' => false
        ])
            ->addColumn('created_by', 'integer', [
                'null' => false
            ])
            ->addColumn('image', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('is_deleted', 'boolean', [
                'default' => false,
                'null' => false
            ])
            ->addForeignKey('project_id', 'projects', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('created_by', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->update();
    }
}
