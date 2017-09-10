<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsFixture
 *
 */
class ProjectsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'id', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'ユーザーid', 'precision' => null, 'autoIncrement' => null],
        'client_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'クライアントid', 'precision' => null, 'autoIncrement' => null],
        'payment_status' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '支払区分', 'precision' => null],
        'price' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '金額', 'precision' => null, 'autoIncrement' => null],
        'shop_name' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '店舗名', 'precision' => null, 'fixed' => null],
        'start__date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '開始日', 'precision' => null],
        'end_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '終了日', 'precision' => null],
        'expense' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '交通費', 'precision' => null, 'autoIncrement' => null],
        'expense_status' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '交通費フラグ', 'precision' => null],
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
            'client_id' => 1,
            'payment_status' => 1,
            'price' => 1,
            'shop_name' => 'Lorem ipsum dolor sit amet',
            'start__date' => '2017-09-10 06:48:14',
            'end_date' => '2017-09-10 06:48:14',
            'expense' => 1,
            'expense_status' => 1
        ],
    ];
}
