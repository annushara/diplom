<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

    /* @var $this yii\web\View */
    /* @var $model app\models\Other */
    /* @var $staff app\models\Staff */
    /* @var $form yii\widgets\ActiveForm */

/* $var objectSystemName app\models\Printers - возвращает объект класса NameSystemUnit  */
?>

<div class="Printers-form">

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

    <?= $form->field($model, 'id_staff')->listBox(ArrayHelper::map($staff->find()->all(), 'id','fio'), ['prompt' => 'Выберите сотрудника', 'size' => 1]); ?>

    <?= $form->field($model, 'invent_num')->textInput() ?>

    <?= $form->field($model, 'category')->textInput(['placeholder'=>'Пример: switch']) ?>

    <?= $form->field($model, 'name')->textInput(['placeholder'=>'Пример: Dlink DGS-1008A.']) ?>

    <?= $form->field($model,'date')->widget(DatePicker::className(),['language'=>'ru','dateFormat' => 'yyyy-MM-dd',]) ?>



    <div class="btn-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
