<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $model app\models\UploadForm */

?>

<?php $form = ActiveForm::begin([
    'id' => 'active-form',
    'options' => [
        'class' => 'form-horizontal col-lg-4',
        'enctype' => 'multipart/form-data'
    ],
]); ?>

<?=$form->field($model, 'staff')->dropDownList( $model->getStaffList(),  ['prompt'=>'Выберите сотрудника'])->label('Сотрудники') ?>
<?= $form->field($model, 'file')->fileInput()->label('Выберите файл конфигурации') ?>

<div class="form-group">
    <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary']) ?>
</div>
    <?php ActiveForm::end() ?>

