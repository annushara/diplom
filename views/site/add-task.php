<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\jui\DatePicker;



?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'add-task']]); ?>

<div id = 'hide' >
    <?= $form->field($model, 'comment')->textarea(['rows' => 4]) ?>
    <div class="error-comment" style="color:red"></div>
    <?= $form->field($model,'date')->widget(DatePicker::className(),['language'=>'ru','dateFormat' => 'yyyy-MM-dd',]) ?>
    <div class="error-date" style="color:red"></div>
    <?= Html::submitButton('Добавить', ['class'=> 'btn btn-danger', ]) ;?>
</div>
<?php ActiveForm::end(); ?>

