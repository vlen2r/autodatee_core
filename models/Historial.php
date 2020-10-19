<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historial".
 *
 * @property int $id
 * @property int $cliente_id
 * @property int $cantidad
 * @property string $fecha
 *
 * @property Cliente $cliente
 */
class Historial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'cantidad', 'fecha'], 'required'],
            [['cliente_id', 'cantidad'], 'integer'],
            [['fecha'], 'safe'],
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
            'cantidad' => 'Cantidad',
            'fecha' => 'Fecha',
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
