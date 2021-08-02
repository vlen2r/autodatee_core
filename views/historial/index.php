<?php

use yii\helpers\Html;
//use yii\grid\GridView;

/**
 * 2021-07-27 Added by Batista for Export in Excel.
 * link: https://www.yiiframework.com/wiki/763/step-by-step-for-how-to-full-export-yii2-grid-to-excel
 */
//use arturoliveira\ExcelView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
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

<?= 
// Me tira el error 
/*
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],      // Array to string conversion
        'clienteNombre',
        //'cliente.nombre',
        'cantidad',
        'fecha',
        //['class' => 'yii\grid\ActionColumn'],
    ];
*/
    ExportMenu::widget([
        'dataProvider' => $dataProvider,
        //'columns' => $gridColumns,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //Agregado por Batista 2021-07-26. Para filtrar mediante el nombre del cliente. Siendo cliente una tabla foranea de Historial.
            'clienteNombre',
            //Fin del agregado Batista 2021-07-26
            'cantidad',
            'fecha',
            //['class' => 'yii\grid\ActionColumn'],
        ],
        'clearBuffers' => true, //optional

        'exportConfig' => [
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_EXCEL => false,
            ExportMenu::FORMAT_PDF => [
                'pdfConfig' => [
                    'methods' => [
                        'SetTitle' => 'Grid Export - Krajee.com',
                        'SetSubject' => 'Generating PDF files via yii2-export extension has never been easy',
                        'SetHeader' => ['Krajee Library Export||Generated On: ' . date("r")],
                        'SetFooter' => ['|Page {PAGENO}|'],
                        'SetAuthor' => 'Kartik Visweswaran',
                        'SetCreator' => 'Kartik Visweswaran',
                        'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, GridView, Grid, yii2-grid, yii2-mpdf, yii2-export',
                    ]
                ]
            ],
        ],
        'dropdownOptions' => [
            'label' => 'Export All',
            'class' => 'btn btn-outline-secondary'
        ],
    ]) . "<hr>\n".
    // Se comenta porque el export ya tiene su propia grid.
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //Agregado por Batista 2021-07-26. Para filtrar mediante el nombre del cliente.
            //Siendo cliente una tabla foranea de Historial.
            'clienteNombre',
            //Fin del agregado Batista 2021-07-26
            'cantidad',
            'fecha',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    
?>


</div>