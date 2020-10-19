<?php

use yii\db\Migration;

/**
 * Class m190809_123332_agregado_fecha_importacion
 */
class m190809_123332_agregado_fecha_importacion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('importacion', 'fecha', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190809_123332_agregado_fecha_importacion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190809_123332_agregado_fecha_importacion cannot be reverted.\n";

        return false;
    }
    */
}
