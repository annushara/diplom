<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

?>

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

        <?= $form->field($model, 'department')->textInput(['maxlength' => 64])->label('Название подразделения') ?>




    <div class="btn-group  ">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary pull-right ']) ?>
        </div>

        <?php ActiveForm::end(); ?>

