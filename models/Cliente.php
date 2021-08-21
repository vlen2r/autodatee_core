<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $url
 * @property string $user
 * @property string $password
 * @property string $token
 *
 * @property Historial[] $historials
 * @property Parametro[] $parametros
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'descripcion', 'url', 'user', 'password', 'token'], 'string', 'max' => 255],
            [['json'], 'string', 'max' => 10000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'url' => 'Url',
            'user' => 'User',
            'password' => 'Password',
            'token' => 'Token / Dealer de Salesforce',
            'json' => 'Json - Modelo API'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorials()
    {
        return $this->hasMany(Historial::className(), ['cliente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametros()
    {
        return $this->hasMany(Parametro::className(), ['cliente_id' => 'id']);
    }
}
