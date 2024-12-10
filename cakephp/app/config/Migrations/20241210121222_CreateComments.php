<?php

use Migrations\AbstractMigration;

class CreateComments extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('comments');
        $table->addColumn('note_id', 'integer', [
            'null' => false
        ])
            ->addColumn('user_id', 'integer', [
                'null' => false
            ])
            ->addColumn('content', 'text', [
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
            ->addForeignKey('note_id', 'notes', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
