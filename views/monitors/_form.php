<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Monitors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monitors-form">

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

    <?= $form->field($model, 'invent_num_monitor_1')->textInput() ?>

    <?= $form->field($model,'date_1')->widget(DatePicker::className(),['language'=>'ru','dateFormat' => 'dd.MM.yyyy',]) ?>

    <?= $form->field($model, 'monitor_1')->textInput() ?>

    <?= $form->field($model, 'invent_num_monitor_2')->textInput() ?>

    <?= $form->field($model,'date_2')->widget(DatePicker::className(),['language'=>'ru','dateFormat' => 'dd.MM.yyyy',]) ?>

    <?= $form->field($model, 'monitor_2')->textInput() ?>



    <div class="btn-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
