<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotesFixture
 */
class NotesFixture extends TestFixture
{
    // /**
    //  * Fields
    //  *
    //  * @var array
    //  */
    // // @codingStandardsIgnoreStart
    // public $fields = [
    //     'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
    //     'user_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
    //     'title' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    //     'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null],
    //     'created_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
    //     'updated_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
    //     '_indexes' => [
    //         'fk_notes_users' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
    //     ],
    //     '_constraints' => [
    //         'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
    //         'fk_notes_users' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
    //     ],
    //     '_options' => [
    //         'engine' => 'InnoDB',
    //         'collation' => 'utf8mb4_0900_ai_ci'
    //     ],
    // ];
    // // @codingStandardsIgnoreEnd
    // /**
    //  * Init method
    //  *
    //  * @return void
    //  */
    // public function init()
    // {
    //     $this->records = [
    //         [
    //             'id' => 1,
    //             'user_id' => 1,
    //             'title' => 'Lorem ipsum dolor sit amet',
    //             'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
    //             'created_at' => 1731402699,
    //             'updated_at' => 1731402699,
    //         ],
    //     ];
    //     parent::init();
    // }

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
