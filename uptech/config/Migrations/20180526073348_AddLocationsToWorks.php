<?php
use Migrations\AbstractMigration;

class AddLocationsToWorks extends AbstractMigration
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
        $table->addColumn('location_add', 'string', [
            'comment' => '出勤場所',
            'default' => null,
            'limit' => 128,
            'null' => true,
            'after' => 'transport_expenses',
        ]);
        $table->addColumn('location_leave', 'string', [
            'comment' => '退勤場所',
            'default' => null,
            'limit' => 128,
            'null' => true,
            'after' => 'location_add',
        ]);
        $table->update();
    }
}
