<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\models\Printers */
/* @var $form yii\widgets\ActiveForm */
/* @var $listPrinters app\controllers\AddController*/
?>

<div class="printers-form">


    <?php $form = ActiveForm::begin([
        'id' => 'config-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => ''

            ],
        ],
    ]); ?>

    <h2>Форма добавления заправки</h2>
    <div class="panel panel-info">

        <div class="panel-body">

            <div class="list-group">

                <?= $form->field($model, 'id_printer')->listBox($listPrinters, ['prompt' => 'Выберите принтер для заправки', 'size' => 1]); ?>

                <?= $form->field($model, 'comment')->textarea() ?>

                <?= $form->field($model, 'date')->widget(DatePicker::className(), ['language' => 'ru', 'dateFormat' => 'dd.MM.yyyy',]) ?>


            </div>
        </div>
    </div>

    <div class="btn-group">

        <?= Html::submitButton($model->isNewRecord ? 'Добавить заправку' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>




</div>
