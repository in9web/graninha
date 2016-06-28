<?php

use Phinx\Migration\AbstractMigration;

class CreateTableProfiles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // create the table
        $table = $this->table('profiles');
        $table->addColumn('name', 'string')
              ->addColumn('status', 'string', array('default' => 'active')) // active, inactive, 
              ->addColumn('user_id', 'integer') // cadastrou no sistema
              ->addColumn('created_at', 'timestamp') // autotimestamps by eloquent
              ->addColumn('updated_at', 'timestamp', array('null' => true)) // autotimestamps by eloquent
              ->addColumn('deleted_at', 'timestamp', array('null' => true)) // eloquent softdeletes
              ->create();
    }
}
