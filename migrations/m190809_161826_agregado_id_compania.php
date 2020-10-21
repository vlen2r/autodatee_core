<?php

use yii\db\Migration;

/**
 * Class m190809_161826_agregado_id_compania
 */
class m190809_161826_agregado_id_compania extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('importacion', 'id_asignado', $this->string(30));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190809_161826_agregado_id_compania cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190809_161826_agregado_id_compania cannot be reverted.\n";

        return false;
    }
    */
}
