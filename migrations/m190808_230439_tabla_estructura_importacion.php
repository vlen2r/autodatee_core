<?php

use yii\db\Migration;

/**
 * Class m190808_230439_tabla_estructura_importacion
 */
class m190808_230439_tabla_estructura_importacion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('importacion', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'telefono' => $this->string(),
            'direccion' => $this->string(),
            'email' => $this->string(),
            'auto' => $this->string(),
            'observaciones' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190808_230439_tabla_estructura_importacion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190808_230439_tabla_estructura_importacion cannot be reverted.\n";

        return false;
    }
    */
}
