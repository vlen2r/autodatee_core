<?php

use yii\db\Migration;

/**
 * Class m190703_230237_initial_database
 */
class m190703_230237_initial_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cliente', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'descripcion' => $this->string(),
            'url' => $this->string(),
            'user' => $this->string(),
            'password' => $this->string(),            
            'token' => $this->string(),
        ]);

        $this->createTable('parametro', [
            'id' => $this->primaryKey(),
            'cliente_id' => $this->integer()->notNull(),
            'parametro' => $this->string()->notNull(),
            'descripcion' => $this->string(),            
        ]);
        
        $this->createIndex(
            'idx-parametro-cliente_id',
            'parametro',
            'cliente_id'
        );
        
        $this->addForeignKey(
            'fk-parametro-cliente_id',
            'parametro',
            'cliente_id',
            'cliente',
            'id',
            'CASCADE'
        );
        
        $this->createTable('historial', [
            'id' => $this->primaryKey(),
            'cliente_id' => $this->integer()->notNull(),
            'cantidad' => $this->integer()->notNull(),
            'fecha' => $this->dateTime()->notNull(),            
        ]);
        
        $this->createIndex(
            'idx-historial-cliente_id',
            'historial',
            'cliente_id'
        );
        
        $this->addForeignKey(
            'fk-historial-cliente_id',
            'historial',
            'cliente_id',
            'cliente',
            'id',
            'CASCADE'
        );
 

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190703_230237_initial_database cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190703_230237_initial_database cannot be reverted.\n";

        return false;
    }
    */
}
