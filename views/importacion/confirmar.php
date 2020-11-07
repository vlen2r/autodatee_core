<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Confirmar datos a importar.';
$this->params['breadcrumbs'][] = $this->title;

$model->token = $token;

?>
<div class="importacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['action' => ['importacion/procesar'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="row">
        <?= $form->field($model, 'token')->hiddenInput()->label(false); ?>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'cliente')->widget(Select2::classname(), [
                'data' => $clientes,
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Datos a importar</h3>
            <?= GridView::widget([
                'dataProvider' => $provider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nombre',
                    'apellido',
                    'telefono',
                    'celular',
                    'direccion',
                    'email',
                    'auto',
                    'observaciones',
                    'vendor'
                ],
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"><br>
            <button class="btn btn-success">Importar</button>
        </div>
    </div>

    <?php ActiveForm::end() ?>

</div>