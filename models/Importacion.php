<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "importacion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $telefono
 * @property string $celular
 * @property string $direccion
 * @property string $email
 * @property string $auto
 * @property string $observaciones
 * @property string $token
 * @property int $importado
 * @property string $fecha
 * @property int $cliente_id
 * @property Cliente $cliente
 * @property string $code_modelo
 */
class Importacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'importacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['importado'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre', 'apellido', 'telefono', 'celular', 'direccion', 'email', 'auto', 'observaciones'], 'string', 'max' => 255],
            [['token', 'vendor', 'id_asignado'], 'string', 'max' => 64],
            [['cliente_id'], 'integer'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['code_modelo'], 'string', 'max' => 64],
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
            'apellido' => 'Apellido',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'direccion' => 'Direccion',
            'email' => 'Email',
            'auto' => 'Auto',
            'observaciones' => 'Observaciones',
            'token' => 'Token',
            'importado' => 'Importado',
            'fecha' => 'Fecha',
            'vendor' => 'Vendor',
            'cliente_id' => 'Cliente ID',
            'clienteNombre' => Yii::t('app', 'Nombre de Cliente'),
            'code_modelo' => 'Codigo Modelo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }

    public function getClienteNombre()
    {
        return $this->cliente->nombre;
    }
}
