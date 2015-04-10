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
        <?= $form->field($model, 'id_department')->listBox(
            $listData,
            array('prompt' => 'Выберите подразделение', 'size' => 1)
        )->label('Подразделения'); ?>
        <?= $form->field($model, 'fio')->textInput(['maxlength' => 64, 'placeholder'=>'Пример: Иванов Петр Сергеевич']) ?>




<div class="btn-group  ">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary ']) ?>
        </div>

        <?php ActiveForm::end(); ?>

