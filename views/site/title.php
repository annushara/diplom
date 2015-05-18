<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $searchModel app\models\SearchMonitors */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title ='Название организации';

?>
<div class="monitors-index">

    <div class="body-content">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-user  "></i> Название организации
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <?php $form = ActiveForm::begin(['options' => ['class' => 'add-person']]); ?>


                        <?= $form->field($model, 'title')->textInput(['placeholder'=>'Введите название организации']) ?>

                        <?= Html::submitButton('Добавить', ['class'=> 'btn btn-danger', ]) ;?>

                        <?php ActiveForm::end(); ?>

                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
