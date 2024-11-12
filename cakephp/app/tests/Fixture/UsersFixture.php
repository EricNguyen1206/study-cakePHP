<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    // /**
    //  * Fields
    //  *
    //  * @var array
    //  */
    // // @codingStandardsIgnoreStart
    // public $fields = [
    //     'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
    //     'username' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    //     'email' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    //     'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
    //     'created_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
    //     '_constraints' => [
    //         'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
    //             'username' => 'Lorem ipsum dolor sit amet',
    //             'email' => 'Lorem ipsum dolor sit amet',
    //             'password' => 'Lorem ipsum dolor sit amet',
    //             'created_at' => 1731401337,
    //         ],
    //     ];
    //     parent::init();
    // }

    public $import = ['table' => 'users'];

    public $records = [
        [
            'id' => 1,
            'username' => 'existinguser',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'created_at' => '2024-11-01 12:00:00'
        ]
    ];
}
