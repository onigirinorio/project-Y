<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '名前', 'precision' => null, 'fixed' => null],
        'name_kana' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '名前カナ', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'パスワード', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'メールアドレス', 'precision' => null, 'fixed' => null],
        'tell' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '電話番号', 'precision' => null, 'autoIncrement' => null],
        'gendar' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '性別', 'precision' => null],
        'birth' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '生年月日', 'precision' => null],
        'zip_code' => ['type' => 'integer', 'length' => 7, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '郵便番号', 'precision' => null, 'autoIncrement' => null],
        'pref' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '都道府県', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 128, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '住所', 'precision' => null, 'fixed' => null],
        'work_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '労働id', 'precision' => null, 'autoIncrement' => null],
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
            'name' => 'Lorem ipsum dolor sit amet',
            'name_kana' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'tell' => 1,
            'gendar' => 1,
            'birth' => '2017-08-20',
            'zip_code' => 1,
            'pref' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'work_id' => 1
        ],
    ];
}
