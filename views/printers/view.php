<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Printers */

?>
<div class="printers-view">

    <div class="panel panel-info">
        <div class="panel-heading">
            <b> <i class=" glyphicon glyphicon-print"> Принтеры</i></b>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="list-group">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'invent_num_printer_1',
                        'print_1',
                        'date_1',
                        'invent_num_printer_2',
                        'print_2',
                        'date_2',
                        'invent_num_printer_3',
                        'print_3',
                        'date_3',
                        'invent_num_printer_4',
                        'print_4',
                        'date_4',
                        'invent_num_printer_5',
                        'print_5',
                        'date_5',

                    ],
                ]) ?>

            </div>
            <!-- /.list-group -->
            <p>
                <?= Html::a('Изменить', ['update_printers', 'id' => $model->id_printer], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete_printers', 'id' => $model->id_printer], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->




</div>
