<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\bootstrap\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $searchModel app\models\SearchMonitors */
    /* @var $dataProvider yii\data\ActiveDataProvider */



?>
<div class="monitors-index">

    <div class="body-content">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text ">   Форма печати акта на списание за выбранный месяц</i>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <?php \yii\widgets\Pjax::begin(); ?>
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


                        <?= $form->field($model, 'mount')->listBox(
                            ['1'=>'Январь',
                            '2'=>'Февраль',
                            '3'=>'Март',
                            '4'=>'Апрель',
                            '5'=>'Май',
                            '6'=>'Июнь',
                            '7'=>'Июль',
                            '8'=>'Август',
                            '9'=>'Сентябрь',
                            '10'=>'Октябрь',
                            '11'=>'Ноябрь',
                            '12'=>'Декабрь',],

                            array('prompt' => 'Выберите месяц', 'size' => 1)
                        )->label('Месяц'); ?>



                        <div class="btn-group">
                            <?= Html::submitButton('Печать Акта', [
                                'class' => 'btn btn-primary',
                                'formtarget'=>'_blank',
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                        <?php \yii\widgets\Pjax::end(); ?>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
