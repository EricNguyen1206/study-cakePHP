<?php
use Migrations\AbstractMigration;

class CreateNotes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('notes');
        $table->addColumn('user_id', 'integer', [
            'null' => true,
            'signed' => true,
        ])
        ->addColumn('project_id', 'integer', ['null' => false])
        ->addColumn('title', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('description', 'text', [
            'null' => true,
        ])
        ->addColumn('image', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('created_at', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])
        ->addColumn('updated_at', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'update' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])
        ->addColumn('is_active', 'boolean', [
            'default' => true,
            'null' => false,
        ])
        ->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
            'constraint' => 'fk_notes_users'
        ])
        ->addForeignKey('project_id', 'projects', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
            'constraint' => 'fk_notes_projects'
        ])
        ->create();
    }
}
