<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\jui\Dialog;


?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'move-form']]); ?>
<p align="center">
    <a class="btn btn-danger move" id="" onclick="$('#hide').show();" >Сотруднику</a>
    <a class="btn btn-danger move" id="<?= $id?>" onclick="sendStore(this);" >на склад</a>

</p>

<div id = 'hide' style = 'display: none'>
<?=$form->field($model, 'staff')->dropDownList( $listData,  ['prompt'=>'Выберите сотрудника',  ])->label('Сотрудники') ?>
<?= Html::submitButton('Переместить', ['class'=> 'btn btn-danger', ]) ;?>
</div>
<?php ActiveForm::end(); ?>

