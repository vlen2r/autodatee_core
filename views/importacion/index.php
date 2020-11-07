<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImportacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros importados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="importacion-index">

    <?php
    if ($message != null) {
        echo Html::tag('h3', $message, ['class' => 'username label-danger', 'style' => 'text-align:center;color:white']);
    }
    ?>
    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'apellido',
            'telefono',
            'celular',
            'direccion',
            'email:email',
            //'auto',
            //'observaciones',
            //'token',
            'vendor',
            'fecha',
            'importado',
            'id_asignado',


            /*['class' => 'yii\grid\ActionColumn'],*/
        ],
    ]); ?>


</div>
