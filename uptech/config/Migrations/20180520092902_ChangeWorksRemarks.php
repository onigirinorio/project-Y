<?php
use Migrations\AbstractMigration;

class ChangeWorksRemarks extends AbstractMigration
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
        $table = $this->table('works');
        $table->changeColumn('remarks', 'string', [
            'limit' => 48,
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
