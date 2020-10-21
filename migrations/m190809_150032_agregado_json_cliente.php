<?php

use yii\db\Migration;

/**
 * Class m190809_150032_agregado_json_cliente
 */
class m190809_150032_agregado_json_cliente extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('importacion', 'json');
        $this->addColumn('cliente', 'json', $this->string(10000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190809_150032_agregado_json_cliente cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190809_150032_agregado_json_cliente cannot be reverted.\n";

        return false;
    }
    */
}
