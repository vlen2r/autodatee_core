<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HistorialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cantidad por cliente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historial-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cliente.nombre',
            'cantidad',
            'fecha',
            /*['class' => 'yii\grid\ActionColumn'],*/
        ],
        /**
         * Agregado por Batista 2021-07-26
         * Para filtrar mediante el nombre del cliente.
         * Siendo cliente una tabla foranea de Historial.
         */
            'clienteNombre',
        //[
        //    'attribute' => 'cliente_id',
        //    'value' => 'cliente.nombre',
        //],
        //Fin del agregado Batista 2021-07-26
    ]); ?>


</div>