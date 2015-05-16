
<?php

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\jui\DatePicker;
    use yii\helpers\ArrayHelper;

    /* @var $this yii\web\View */
    /* @var $model app\models\Staff*/


?>

<div class="monitors-form">
    <div class="body-content">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text ">   Форма печати карточки сотрудника</i>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
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

    <?= $form->field($model, 'fio')->listBox(ArrayHelper::map($model->find()->all(), 'id','fio'), ['prompt' => 'Выберите сотрудника', 'size' => 1]); ?>

    <div class="btn-group">
        <?= Html::submitButton('Печать карточки сотрудника', [
            'class' => 'btn btn-primary',
            'formtarget'=>'_blank',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
</div>
