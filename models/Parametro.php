<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametro".
 *
 * @property int $id
 * @property int $cliente_id
 * @property string $parametro
 * @property string $descripcion
 *
 * @property Cliente $cliente
 */
class Parametro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parametro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'parametro'], 'required'],
            [['cliente_id'], 'integer'],
            [['parametro', 'descripcion'], 'string', 'max' => 255],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente ID',
            'parametro' => 'Parametro',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }
}
