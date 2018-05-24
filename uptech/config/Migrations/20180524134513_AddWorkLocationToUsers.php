<?php
use Migrations\AbstractMigration;

class AddWorkLocationToUsers extends AbstractMigration
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
        $table->addColumn('work_location', 'string', [
            'comment' => '勤務先',
            'default' => null,
            'limit' => 128,
            'null' => true,
            'after' => 'expense_price',
        ]);
        $table->update();
    }
}
