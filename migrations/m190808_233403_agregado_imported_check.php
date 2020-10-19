<?php

use yii\db\Migration;

/**
 * Class m190808_233403_agregado_imported_check
 */
class m190808_233403_agregado_imported_check extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('importacion', 'importado', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190808_233403_agregado_imported_check cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190808_233403_agregado_imported_check cannot be reverted.\n";

        return false;
    }
    */
}
