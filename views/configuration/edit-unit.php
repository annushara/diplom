
<?php

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\jui\DatePicker;
    use yii\bootstrap\Alert;


    /* @var $this yii\web\View */
    /* @var $form yii\widgets\ActiveForm */
    /* @var $model app\models\NameSystemUnit */
?>

<div class="configuration-form">

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



    <?= $form->field($model, 'name')->textInput() ?>

    <div class="btn-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>