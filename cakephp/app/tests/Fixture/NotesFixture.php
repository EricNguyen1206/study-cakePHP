<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotesFixture
 */
class NotesFixture extends TestFixture
{
    public $import = ['table' => 'notes'];

    public $records = [
        [
            'id' => 1,
            'user_id' => 1,
            'title' => 'First Note',
            'description' => 'This is the first note.',
            'created_at' => '2024-11-01 12:30:00',
            'updated_at' => '2024-11-01 12:30:00'
        ]
    ];
}
