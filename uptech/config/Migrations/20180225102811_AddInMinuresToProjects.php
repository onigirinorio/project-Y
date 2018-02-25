<?php
use Migrations\AbstractMigration;

class AddInMinuresToProjects extends AbstractMigration
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
        $table->addColumn('in_minutes', 'integer', [
            'default' => 0,
            'limit' => 4,
            'null' => false,
            'after' => 'payment_status',
        ]);
        $table->update();
    }
}
