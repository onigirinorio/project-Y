<?php
use Migrations\AbstractMigration;

class AddUsersAdminFlg extends AbstractMigration
{
    public function up()
    {

        $this->table('clients')
            ->addColumn('client_name', 'string', [
                'comment' => 'クライアント名',
                'default' => null,
                'limit' => 128,
                'null' => false,
            ])
            ->addColumn('tell', 'string', [
                'comment' => '電話番号',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('zip_code', 'integer', [
                'comment' => '郵便番号',
                'default' => null,
                'limit' => 7,
                'null' => true,
            ])
            ->addColumn('pref', 'string', [
                'comment' => '都道府県',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('address', 'string', [
                'comment' => '住所',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->create();

        $this->table('projects')
            ->addColumn('client_id', 'integer', [
                'comment' => 'クライアントid',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('payment_status', 'boolean', [
                'comment' => '支払区分',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('price', 'integer', [
                'comment' => '金額',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('shop_name', 'string', [
                'comment' => '店舗名',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('start_date', 'datetime', [
                'comment' => '開始日',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end_date', 'datetime', [
                'comment' => '終了日',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('expense', 'integer', [
                'comment' => '交通費',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('expense_status', 'boolean', [
                'comment' => '交通費フラグ',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('shifts')
            ->addColumn('user_id', 'integer', [
                'comment' => 'ユーザーid',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('date', 'date', [
                'comment' => '日付',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('attend', 'time', [
                'comment' => '出勤時間',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('clock', 'time', [
                'comment' => '退勤時間',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('holiday_flag', 'boolean', [
                'comment' => '休日フラグ',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('create_user', 'string', [
                'comment' => '作成者',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('create_at', 'datetime', [
                'comment' => '作成日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('update_user', 'string', [
                'comment' => '更新者',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('upteda_at', 'datetime', [
                'comment' => '更新日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('users')
            ->addColumn('name', 'string', [
                'comment' => '名前',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('name_kana', 'string', [
                'comment' => '名前カナ',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'comment' => 'パスワード',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'comment' => 'メールアドレス',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('tell', 'integer', [
                'comment' => '電話番号',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('gendar', 'boolean', [
                'comment' => '性別',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('birth', 'date', [
                'comment' => '生年月日',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('zip_code', 'integer', [
                'comment' => '郵便番号',
                'default' => null,
                'limit' => 7,
                'null' => true,
            ])
            ->addColumn('pref', 'string', [
                'comment' => '都道府県',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('address', 'string', [
                'comment' => '住所',
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('admin_flg', 'tinyinteger', [
                'default' => '0',
                'limit' => 2,
                'null' => false,
            ])
            ->create();

        $this->table('works')
            ->addColumn('user_id', 'integer', [
                'comment' => 'ユーザーid',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('project_id', 'integer', [
                'comment' => 'プロジェクトid',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('attend_time', 'time', [
                'comment' => '出勤時間',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('leave_time', 'time', [
                'comment' => '退勤時間',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('break_time', 'time', [
                'comment' => '休憩時間',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('overtime', 'time', [
                'comment' => '残業時間',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('create_at', 'datetime', [
                'comment' => '作成日時',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('clients');
        $this->dropTable('projects');
        $this->dropTable('shifts');
        $this->dropTable('users');
        $this->dropTable('works');
    }
}
