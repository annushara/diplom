<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Refill */

$this->title = 'Update Refill: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Refills', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="refill-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
