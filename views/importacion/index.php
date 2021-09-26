<?php

use yii\helpers\Html;
//use yii\grid\GridView;

/**
 * 2021-08-13 Added by Batista for Export in Excel.
 * link: https://www.yiiframework.com/wiki/763/step-by-step-for-how-to-full-export-yii2-grid-to-excel
 */
//use arturoliveira\ExcelView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
//2021-08-13 - End of the add by Batista

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



    <?= 
    
    /**
     * 2021-07-27 Added by Batista for Export in Excel.
     * link: https://www.yiiframework.com/wiki/763/step-by-step-for-how-to-full-export-yii2-grid-to-excel
     */
    
     // Me tira el error 
    /*
    $gridColumns = [
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
            //['class' => 'yii\grid\ActionColumn'],
        ];
    */
    ExportMenu::widget([
        'dataProvider' => $dataProvider,
        //'columns' => $gridColumns,
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
            'clienteNombre',
            /*['class' => 'yii\grid\ActionColumn'],*/
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
    
    //2021-07-27 - End of the add by Batista
    
    GridView::widget([
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
            'clienteNombre',
            /*['class' => 'yii\grid\ActionColumn'],*/
        ],
    ]); ?>


</div>
