<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConfigurationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_configuration') ?>

    <?= $form->field($model, 'invent_num_system') ?>

    <?= $form->field($model, 'invent_num_monitor') ?>

    <?= $form->field($model, 'invent_num_printer') ?>

    <?= $form->field($model, 'cpu') ?>

    <?php // echo $form->field($model, 'motherboard') ?>

    <?php // echo $form->field($model, 'graphics') ?>

    <?php // echo $form->field($model, 'monitor_1') ?>

    <?php // echo $form->field($model, 'monitor_2') ?>

    <?php // echo $form->field($model, 'hdd_1') ?>

    <?php // echo $form->field($model, 'hdd_2') ?>

    <?php // echo $form->field($model, 'memory_1') ?>

    <?php // echo $form->field($model, 'memory_2') ?>

    <?php // echo $form->field($model, 'memory_3') ?>

    <?php // echo $form->field($model, 'memory_4') ?>

    <?php // echo $form->field($model, 'mac') ?>

    <?php // echo $form->field($model, 'print_1') ?>

    <?php // echo $form->field($model, 'print_2') ?>

    <?php // echo $form->field($model, 'print_3') ?>

    <?php // echo $form->field($model, 'print_4') ?>

    <?php // echo $form->field($model, 'print_5') ?>

    <?php // echo $form->field($model, 'print_6') ?>

    <?php // echo $form->field($model, 'print_7') ?>

    <?php // echo $form->field($model, 'print_8') ?>

    <?php // echo $form->field($model, 'print_9') ?>

    <?php // echo $form->field($model, 'print_10') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
