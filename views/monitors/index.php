<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchMonitors */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мониторы';

?>
<div class="monitors-index">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class=" glyphicon  icon-display" ></i> Мониторы расположенные на складе
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'showFooter'=>true,
        'showHeader' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nameMonitor.name',
            'invent_num',
            'date',
            'historyDiscarded.date',
            'historyDiscarded.comment',


            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a('<span class="glyphicon glyphicon-export"></span>',
                            [''],
                            [
                                'title'=>'Переместить сотруднику',
                                'onclick'=>'sendOneTo(this); return false;',
                                'data-sendto'=>"staff",
                                'data-name'=>'monitor',
                                'data-item'=>$model->id,
                            ]
                        );
                    },

                ],

            ],
        ],
    ]); ?>
            </div>
            <!-- /.list-group -->

        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
    <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm ">
            <div class="modal-content">
                <div class="modal-body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

