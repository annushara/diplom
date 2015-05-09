<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;



?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'move-form-one']]); ?>

<div id = 'hide' >
         <div id="list-staff">
            <?=$form->field($model, 'staff')->dropDownList( $listData,  ['prompt'=>'Выберите сотрудника',  ])->label('Сотрудники') ?>
            <div class="error" style="color:red"></div>
        </div>

    <?= $form->field($model, 'comment')->textarea(['rows' => 4])->label('Причина перемещения') ?>
    <?= Html::submitButton('Переместить', ['class'=> 'btn btn-danger', ]) ;?>
</div>
<?php ActiveForm::end(); ?>

