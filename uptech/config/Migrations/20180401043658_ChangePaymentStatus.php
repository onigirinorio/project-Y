<?php
use Migrations\AbstractMigration;

class ChangePaymentStatus extends AbstractMigration
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
        $table->changeColumn('payment_status', 'integer', [
            'default' => 1,
            'null' => false,
        ]);
        $table->update();
    }
}
