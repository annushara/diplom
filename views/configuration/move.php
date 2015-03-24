<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\jui\Dialog;


?>
<h2>Назначение конфигурации новому сотруднику </h2>

<?php $form = ActiveForm::begin([
    'id' => 'active-form',
    'options' => [
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data',


    ],
]);?>

<?= $form->field($model, 'staff')->listBox(
    $listData,
    array('prompt' => '', 'size' => 1 )
)->label('Выберите сотрудника'); ?>
<?= Html::submitButton('Переместить', ['class'=> 'btn btn-danger']) ;?>
<?php ActiveForm::end(); ?>

