<?php
use Migrations\AbstractMigration;

class UpdateShift extends AbstractMigration
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
        $table = $this->table('shifts');
        $table->renameColumn('upteda_at', 'update_at');
        $table->update();
    }
}
