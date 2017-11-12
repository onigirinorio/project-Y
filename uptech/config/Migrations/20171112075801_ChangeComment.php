<?php
use Migrations\AbstractMigration;

class ChangeComment extends AbstractMigration
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
        $table->changeColumn('tell', 'string', [
            'limit' => 11,
            'default' => '0',
            'null' => false,
        ]);
        $table->renameColumn('gendar', 'gender');
        $table->update();
    }
}
