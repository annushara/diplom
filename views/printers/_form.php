<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\models\Printers */
/* @var $form yii\widgets\ActiveForm */
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


    <div class="panel panel-info">
        <div class="panel-body">
            <div class="list-group">

                <?= $form->field($modelName, 'name[0]')->listBox($listData, ['prompt' => '', 'size' => 1]); ?>

                <?= $form->field($model, 'invent_num[0]')->textInput() ?>

                <?= $form->field($model, 'date[0]')->widget(DatePicker::className(), ['language' => 'ru', 'dateFormat' => 'dd.MM.yyyy',]) ?>


            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="list-group">

                <?= $form->field($modelName, 'name[1]')->listBox($listData, ['prompt' => '', 'size' => 1]); ?>

                <?= $form->field($model, 'invent_num[1]')->textInput() ?>

                <?= $form->field($model, 'date[1]')->widget(DatePicker::className(), ['language' => 'ru', 'dateFormat' => 'dd.MM.yyyy',]) ?>


            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="list-group">

                <?= $form->field($modelName, 'name[2]')->listBox($listData, ['prompt' => '', 'size' => 1]); ?>

                <?= $form->field($model, 'invent_num[2]')->textInput() ?>

                <?= $form->field($model, 'date[2]')->widget(DatePicker::className(), ['language' => 'ru', 'dateFormat' => 'dd.MM.yyyy',]) ?>



            </div>
        </div>
    </div>
    <div class="btn-group">

        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>




</div>
