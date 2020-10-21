<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Historial */

$this->title = 'Create Historial';
$this->params['breadcrumbs'][] = ['label' => 'Historials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
