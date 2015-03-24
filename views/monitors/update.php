<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Monitors */

$this->title = 'Update Monitors: ' . ' ' . $model->id_monitor;
$this->params['breadcrumbs'][] = ['label' => 'Monitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_monitor, 'url' => ['view', 'id' => $model->id_monitor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="monitors-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
