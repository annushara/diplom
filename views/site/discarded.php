<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchMonitors */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;

?>
<div class="monitors-index">

    <div class="body-content">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-user  "></i> <?=$title?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">



                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'summary'=>'',
                                'showFooter'=>true,
                                'showHeader' => true,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'label' => 'Последний владелец',
                                        'attribute'=>'fio',
                                        'value'=>'historyDiscarded.oldStaff.fio',
                                    ],



                                    [
                                        'label' => 'Название',
                                        'value'=> function($searchModel){
                                            if(get_class($searchModel)== 'app\models\Monitors' ){
                                                return $searchModel->nameMonitor->name;
                                            }else if(get_class($searchModel)=='app\models\SystemUnit'){
                                                return $searchModel->nameSystemUnit->name;
                                            }else if(get_class($searchModel)=='app\models\Printers'){
                                                return $searchModel->idNamePrinter->name;
                                            }else if(get_class($searchModel)=='app\models\Other'){
                                                return $searchModel->name;
                                            }else{
                                                return 'Название отсутсвует';
                                            }

                                        },
                                    ],
                                    'invent_num',
                                    [
                                        'label' => 'Дата поступления',
                                        'attribute'=>'date',

                                    ],


                                    [
                                        'label' => 'Дата списания',
                                        'attribute'=>'dateHistory',
                                        'value'=>'historyDiscarded.date',
                                    ],
                                    [
                                        'label' => 'Комментарий',
                                        'attribute'=>'comment',
                                        'value'=>'historyDiscarded.comment',
                                    ],

                                    ['class' => 'yii\grid\ActionColumn',
                                    'template' => '',
                                    ],
                                ],
                            ]); ?>

                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
</div>
