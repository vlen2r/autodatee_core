<?php

use yii\db\Migration;

/**
 * Class m190809_145915_agregado_json_importacion
 */
class m190809_145915_agregado_json_importacion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('importacion', 'json', $this->string(10000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190809_145915_agregado_json_importacion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190809_145915_agregado_json_importacion cannot be reverted.\n";

        return false;
    }
    */
}
