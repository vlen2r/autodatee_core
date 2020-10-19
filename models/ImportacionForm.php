<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImportacionForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $cliente;
    public $token;


    public function rules()
    {
        return [
            [['cliente'], 'required'],
            [['token'], 'safe'],
        ];
    }
}
