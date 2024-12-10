<?php

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', [
            'limit' => 50,
            'null' => false
        ])
            ->addIndex(['username'], ['unique' => true]) // Unique index
            ->addColumn('email', 'string', [
                'limit' => 100,
                'null' => true
            ])
            ->addIndex(['email'], ['unique' => true]) // Unique index
            ->addColumn('password', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('role', 'enum', [
                'values' => ['project_manager', 'developer'],
                'null' => false
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => true
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
