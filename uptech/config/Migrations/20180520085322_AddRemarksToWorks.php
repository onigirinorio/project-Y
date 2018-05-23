<?php
use Migrations\AbstractMigration;

class AddRemarksToWorks extends AbstractMigration
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
        $table->addColumn('remarks', 'text', [
            'comment' => '備考',
            'default' => null,
            'limit' => null,
            'null' => true,
            'after' => 'overtime',
        ]);
        $table->addColumn('transport_expenses', 'integer', [
            'comment' => '交通費',
            'default' => 0,
            'limit' => 11,
            'null' => true,
            'after' => 'remarks',
        ]);
        $table->update();
    }
}
