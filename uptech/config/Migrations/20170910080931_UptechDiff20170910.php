<?php
use Migrations\AbstractMigration;

class UptechDiff20170910 extends AbstractMigration
{

    public function up()
    {

        $this->table('clients')
            ->removeColumn('client_id')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('projects')
            ->removeColumn('start__date')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('shifts')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('users')
            ->removeColumn('work_id')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('works')
            ->removeColumn('employee_id')
            ->removeColumn('employment_id')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('projects')
            ->addColumn('start_date', 'datetime', [
                'after' => 'shop_name',
                'comment' => '開始日',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('shifts')
            ->addColumn('user_id', 'integer', [
                'after' => 'id',
                'comment' => 'ユーザーid',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('works')
            ->addColumn('user_id', 'integer', [
                'after' => 'id',
                'comment' => 'ユーザーid',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->addColumn('project_id', 'integer', [
                'after' => 'user_id',
                'comment' => 'プロジェクトid',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('clients')
            ->addColumn('client_id', 'integer', [
                'after' => 'id',
                'comment' => 'クライアントid',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('projects')
            ->addColumn('start__date', 'datetime', [
                'after' => 'shop_name',
                'comment' => '開始日',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->removeColumn('start_date')
            ->update();

        $this->table('shifts')
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->removeColumn('user_id')
            ->update();

        $this->table('users')
            ->addColumn('work_id', 'integer', [
                'after' => 'address',
                'comment' => '労働id',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('works')
            ->addColumn('employee_id', 'integer', [
                'after' => 'id',
                'comment' => '従業員id',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->addColumn('employment_id', 'integer', [
                'after' => 'employee_id',
                'comment' => '雇用区分id',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->removeColumn('user_id')
            ->removeColumn('project_id')
            ->update();
    }
}

