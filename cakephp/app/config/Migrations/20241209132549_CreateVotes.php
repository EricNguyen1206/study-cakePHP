<?php

use Migrations\AbstractMigration;

class CreateVotes extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('votes');
        $table->addColumn('post_id', 'integer', [
            'null' => false
        ])
            ->addColumn('user_id', 'integer', [
                'null' => false
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false
            ])
            ->addForeignKey('post_id', 'posts', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addIndex(['post_id', 'user_id'], ['unique' => true]) // Ensures a user votes only once per post
            ->create();
    }
}
