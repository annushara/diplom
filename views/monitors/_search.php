<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchMonitors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monitors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_monitor') ?>

    <?= $form->field($model, 'invent_num_monitor_1') ?>

    <?= $form->field($model, 'invent_num_monitor_2') ?>

    <?= $form->field($model, 'monitor_1') ?>

    <?= $form->field($model, 'monitor_2') ?>

    <?php // echo $form->field($model, 'date_1') ?>

    <?php // echo $form->field($model, 'date_2') ?>

    <?php // echo $form->field($model, 'old_staff_1') ?>

    <?php // echo $form->field($model, 'old_staff_2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
