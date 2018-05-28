<?php
use Migrations\AbstractMigration;

class AddWorkLocationtoWorks extends AbstractMigration
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
        $table->addColumn('work_location', 'string', [
            'comment' => '勤務先',
            'default' => null,
            'limit' => 128,
            'null' => true,
            'after' => 'location_leave',
        ]);
        $table->update();
    }
}
