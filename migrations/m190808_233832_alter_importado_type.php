<?php

use yii\db\Migration;

/**
 * Class m190808_233832_alter_importado_type
 */
class m190808_233832_alter_importado_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('importacion', 'importado', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190808_233832_alter_importado_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190808_233832_alter_importado_type cannot be reverted.\n";

        return false;
    }
    */
}
