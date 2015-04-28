<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;



?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'move-form']]); ?>
<p align="center">
    <a class="btn btn-danger move" id="" onclick="$('#hide').show();" >Сотруднику</a>
    <a class="btn btn-danger move" id="<?= $id?>" onclick="sendStore(this);" >на склад</a>

</p>

<div id = 'hide' style = 'display: none'>
<?=$form->field($model, 'staff')->dropDownList( $listData,  ['prompt'=>'Выберите сотрудника',  ])->label('Сотрудники') ?>
 <div class="error" style="color:red"></div>
<?= $form->field($model, 'comment')->textarea(['rows' => 4])->label('Причина перемещения') ?>
<?= Html::submitButton('Переместить', ['class'=> 'btn btn-danger', ]) ;?>
</div>
<?php ActiveForm::end(); ?>

