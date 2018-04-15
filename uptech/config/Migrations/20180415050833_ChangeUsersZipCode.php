<?php
use Migrations\AbstractMigration;

class ChangeUsersZipCode extends AbstractMigration
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
        $table->changeColumn('zip_code', 'string', [
            'limit' => 255,
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
