
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SystemUnit */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelName app\models\NameSystemUnit */
/* $var objectSystemName app\models\SystemUnit - возвращает объект класса NameSystemUnit  */
?>

<div class="system-form">

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

    <?= $form->field($model, 'id_staff')->listBox(ArrayHelper::map($model->objectStaff->find()->where(['status'=>\app\models\Staff::STATUS_ACTIVE])->all(), 'id','fio'), ['prompt' => '', 'size' => 1]); ?>

    <?= $form->field($model, 'invent_num')->textInput() ?>

    <?= $form->field($model,'date')->widget(DatePicker::className(),['language'=>'ru','dateFormat' => 'yyyy-MM-dd',]) ?>

    <?= $form->field($model, 'id_name_system_unit')->listBox(ArrayHelper::map($model->objectSystemName->find()->all(), 'id','name'), ['prompt' => 'Список добавленных конфигураций','size' => 1,'onclick'=>'if($("#systemunit-id_name_system_unit").val()){$("#systemunit-name").attr("disabled", "disabled")}else{$("#systemunit-name").removeAttr("disabled")}'])->label('Доступные конфигурации'); ?>

    <?= $form->field($model, 'name')->textInput(['placeholder'=>'Введите свою конфигурацию или выберете из списка уже добавленных.']) ?>

    <div class="btn-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
