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

    <?= $this->widget('EExcelView', array(
        'dataProvider'=> $dataprovider,
        'title'=>'Title',
        'autoWidth'=>false,
        ));?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cliente.nombre',
            'cantidad',
            'fecha',
            /**
             * Agregado por Batista 2021-07-26
             * Para filtrar mediante el nombre del cliente.
             * Siendo cliente una tabla foranea de Historial.
             */
            'clienteNombre',
            //Fin del agregado Batista 2021-07-26
            /*['class' => 'yii\grid\ActionColumn'],*/
        ],
    ]); ?>


</div>