<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Importacion */

$this->title = 'Create Importacion';
$this->params['breadcrumbs'][] = ['label' => 'Importacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="importacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
