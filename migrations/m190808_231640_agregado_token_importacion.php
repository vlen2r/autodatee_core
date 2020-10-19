<?php

use yii\db\Migration;

/**
 * Class m190808_231640_agregado_token_importacion
 */
class m190808_231640_agregado_token_importacion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('importacion', 'token', $this->string(64));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190808_231640_agregado_token_importacion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190808_231640_agregado_token_importacion cannot be reverted.\n";

        return false;
    }
    */
}
