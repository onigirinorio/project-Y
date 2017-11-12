<?php
use Migrations\AbstractMigration;

class ChangeUsers2 extends AbstractMigration
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
            'default' => NULL,
            'null' => true,
        ]);
    }
}
