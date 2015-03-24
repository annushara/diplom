<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchPrinters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="printers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_printer') ?>

    <?= $form->field($model, 'invent_num_printer_1') ?>

    <?= $form->field($model, 'invent_num_printer_2') ?>

    <?= $form->field($model, 'print_1') ?>

    <?= $form->field($model, 'print_2') ?>

    <?php // echo $form->field($model, 'print_3') ?>

    <?php // echo $form->field($model, 'print_4') ?>

    <?php // echo $form->field($model, 'print_5') ?>

    <?php // echo $form->field($model, 'print_6') ?>

    <?php // echo $form->field($model, 'print_7') ?>

    <?php // echo $form->field($model, 'print_8') ?>

    <?php // echo $form->field($model, 'print_9') ?>

    <?php // echo $form->field($model, 'print_10') ?>

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
