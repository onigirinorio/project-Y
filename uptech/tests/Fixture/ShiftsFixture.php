<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ShiftsFixture
 *
 */
class ShiftsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'id', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'ユーザーid', 'precision' => null, 'autoIncrement' => null],
        'date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '日付', 'precision' => null],
        'attend' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '出勤時間', 'precision' => null],
        'clock' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '退勤時間', 'precision' => null],
        'holiday_flag' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '休日フラグ', 'precision' => null],
        'create_user' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '作成者', 'precision' => null, 'fixed' => null],
        'create_at' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '作成日時', 'precision' => null],
        'update_user' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '更新者', 'precision' => null, 'fixed' => null],
        'upteda_at' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '更新日時', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'user_id' => 1,
            'date' => '2017-09-10',
            'attend' => '08:17:12',
            'clock' => '08:17:12',
            'holiday_flag' => 1,
            'create_user' => 'Lorem ipsum dolor sit amet',
            'create_at' => '2017-09-10 08:17:12',
            'update_user' => 'Lorem ipsum dolor sit amet',
            'upteda_at' => '2017-09-10 08:17:12'
        ],
    ];
}
