<?php
use Migrations\AbstractMigration;

class AddDateAndExpense extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('start_date', 'datetime', [
            'comment' => '開始日',
            'default' => null,
            'limit' => null,
            'null' => true,
            'after' => 'address',
        ]);
        $table->addColumn('end_date', 'datetime', [
            'comment' => '終了日',
            'default' => null,
            'limit' => null,
            'null' => true,
            'after' => 'start_date',
        ]);
        $table->addColumn('expense_route', 'string', [
            'comment' => '交通経路',
            'default' => null,
            'limit' => 128,
            'null' => false,
            'after' => 'end_date',
        ]);
        $table->addColumn('expense_price', 'integer', [
            'comment' => '交通費',
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'expense_route',
        ]);
        $table->update();
    }
}
