<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Monitors */

?>
<div class="monitors-view">


        <div class="panel panel-info">
            <div class="panel-heading">
               <b> <i class="fa fa-desktop"> Мониторы</i></b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="list-group">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'invent_num_monitor_1',
                            'invent_num_monitor_2',
                            'monitor_1',
                            'monitor_2',
                            'date_1',
                            'date_2',
                        ],
                    ]) ?>
                </div>
                <!-- /.list-group -->
                <p>
                    <?= Html::a('Изменить', ['update_monitors', 'id' => $model->id_monitor], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Удалить', ['delete_monitors', 'id' => $model->id_monitor], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Вы точно хотите удалить эту конфигурацию мониторов?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->



</div>
