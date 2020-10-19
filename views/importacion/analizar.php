<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Importacion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="importacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->errorSummary($model); ?>
            <?= $form->field($model, 'imageFile')->fileInput()->label('Subir archivo csv') ?>
            <a href="/ejemplo.csv">CSV Ejemplo</a>
        </div>
        <div class="col-md-4"><br>
            <button class="btn btn-danger">Analizar</button>
        </div>

    </div>

    <?php ActiveForm::end() ?>

</div>