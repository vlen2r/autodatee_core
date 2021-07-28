<?php

use yii\helpers\Html;
//use yii\grid\GridView;

/**
 * 2021-07-27 Added by Batista for Export in Excel.
 * link: https://www.yiiframework.com/wiki/763/step-by-step-for-how-to-full-export-yii2-grid-to-excel
 */
use arturoliveira\ExcelView;
use kartik\grid\GridView;
//2021-07-27 - End of the add by Batista

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
            /**
             * Agregado por Batista 2021-07-26
             * Para filtrar mediante el nombre del cliente.
             * Siendo cliente una tabla foranea de Historial.
             */
            'clienteNombre',
            //Fin del agregado Batista 2021-07-26
            /*['class' => 'yii\grid\ActionColumn'],*/
        ],
        'layout' => '{summary}<div class="pull-right">{export}&nbsp{fullexport}&nbsp</div><div>{items}</div>{pager}',
        /*
        'exportConfig' => [
            \kartik\grid\GridView::EXCEL => ['label' => 'Export to Excel'],
        ],
        'fullExportConfig' => [
            ExcelView::FULL_EXCEL => [],
            //ExcelView::FULL_CSV => ['label' => 'Save as CSV'],
            //ExcelView::FULL_HTML => [],
        ],
        */
    ]); ?>


</div>