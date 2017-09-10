<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WorksFixture
 *
 */
class WorksFixture extends TestFixture
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
        'project_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'プロジェクトid', 'precision' => null, 'autoIncrement' => null],
        'attend_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '出勤時間', 'precision' => null],
        'leave_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '退勤時間', 'precision' => null],
        'break_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '休憩時間', 'precision' => null],
        'overtime' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '残業時間', 'precision' => null],
        'create_at' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '作成日時', 'precision' => null],
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
            'project_id' => 1,
            'attend_time' => '08:17:01',
            'leave_time' => '08:17:01',
            'break_time' => '08:17:01',
            'overtime' => '08:17:01',
            'create_at' => '2017-09-10 08:17:01'
        ],
    ];
}
