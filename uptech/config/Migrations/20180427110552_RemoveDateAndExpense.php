<?php
use Migrations\AbstractMigration;

class RemoveDateAndExpense extends AbstractMigration
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
        $table = $this->table('projects');
        $table->removeColumn('start_date');
        $table->removeColumn('end_date');
        $table->removeColumn('expense');
        $table->update();
    }
}
