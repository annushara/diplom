<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */


?>
<div class="configuration-view">

    <div class="panel panel-info">
        <div class="panel-heading">
            <b> <i class="fa   fa-gears   ">  Конфигурация</i></b>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="list-group">
                <?=  DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'date',
                        //'id_configuration:html',
                        'invent_num_system:html',
                        'cpu:html',
                        'motherboard:html',
                        'graphics:html',
                        'hdd_1:html',
                        'hdd_2:html',
                        'memory_1:html',
                        'memory_2:html',
                        'memory_3:html',
                        'memory_4:html',
                        'mac:html',
                    ],
                ]) ?>
            </div>
            <!-- /.list-group -->
            <p>
                <?= Html::a('Изменить', ['update_configuration', 'id' => $model->id_configuration], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Переместить', ['move_configuration', 'id' => $model->id_configuration], ['class' => 'btn btn-success', 'data'=>['method' => 'post'],]) ?>
                <?= Html::a('Удалить', ['delete_configuration', 'id' => $model->id_configuration], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить данную конфигурацию?',
                        'method' => 'post',
                    ],
                ])
                ?>

            </p>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->




</div>
