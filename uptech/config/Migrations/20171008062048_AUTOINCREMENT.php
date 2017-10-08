<?php
use Migrations\AbstractMigration;

class AUTOINCREMENT extends AbstractMigration
{

    public function up()
    {

        $this->table('clients')
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('shifts')
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('users')
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('works')
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('clients')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('shifts')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('users')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('works')
            ->changeColumn('id', 'integer', [
                'comment' => 'id',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();
    }
}

