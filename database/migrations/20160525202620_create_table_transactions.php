<?php

use Phinx\Migration\AbstractMigration;

class CreateTableTransactions extends AbstractMigration
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
        $table = $this->table('transactions');
        $table->addColumn('description', 'string')
              ->addColumn('profile_id', 'integer') // perfil do lancamento  
              ->addColumn('account_id', 'integer', array('default' => 1)) // conta do lancamento padrao 1s
              ->addColumn('category_id', 'integer') // categoria 
              ->addColumn('payee_name', 'string') // favorecido
              ->addColumn('inout', 'string') // in, out se eh entrada ou saida 
              ->addColumn('amount', 'decimal', array('precision' => 10, 'scale' => 2)) // valor do lancamento 1 234 567 890,00
              ->addColumn('tax_value', 'decimal', array('precision' => 10, 'scale' => 2), array('default' => 0)) // valor da taxa pago (atraso e outros)
              ->addColumn('tags', 'string') // tags para uso futuro
              ->addColumn('info', 'text') // observacoes sobre o lancamento
              ->addColumn('status', 'string', array('default' => 'active')) // active, inactive, 
              ->addColumn('user_id', 'integer') // cadastrou no sistema
              ->addColumn('due_date_at', 'timestamp')
              ->addColumn('payed_at', 'timestamp', array('null' => true))
              ->addColumn('created_at', 'timestamp') // autotimestamps by eloquent
              ->addColumn('updated_at', 'timestamp', array('null' => true)) // autotimestamps by eloquent
              ->addColumn('deleted_at', 'timestamp', array('null' => true)) // eloquent softdeletes
              //->addIndex(array('profile_id'), array('unique' => true))
              ->create();

    }
}
