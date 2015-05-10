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
                                    'label' => 'Название',
                                    'value'=> function($searchModel){
                                        if(get_class($searchModel)== 'app\models\HistoryMonitors' ){
                                            return $searchModel->idMonitor->nameMonitor->name;
                                        }else if(get_class($searchModel)=='app\models\HistorySystemUnit'){
                                            return $searchModel->idSystemUnit->nameSystemUnit->name;
                                        }else if(get_class($searchModel)=='app\models\HistoryPrinters'){
                                            return $searchModel->idPrinter->idNamePrinter->name;
                                        }else if(get_class($searchModel)=='app\models\HistoryOther'){
                                            return $searchModel->idConfiguration->name;
                                        }else{
                                            return '';
                                        }

                                    },
                                ],
                                [
                                    'label' => 'Инвентарный №',
                                    'value'=> function($searchModel){
                                        if(get_class($searchModel)== 'app\models\HistoryMonitors' ){
                                            return $searchModel->idMonitor->invent_num;
                                        }else if(get_class($searchModel)=='app\models\HistorySystemUnit'){
                                            return $searchModel->idSystemUnit->invent_num;
                                        }else if(get_class($searchModel)=='app\models\HistoryPrinters'){
                                            return $searchModel->idPrinter->invent_num;
                                        }else if(get_class($searchModel)=='app\models\HistoryOther'){
                                            return $searchModel->idConfiguration->invent_num;
                                        }else{
                                            return '';
                                        }

                                    },
                                ],
                              /// 'idMonitor.invent_num',

                                [
                                    'label'=>'От кого',
                                    'attribute'=>'old_staff',
                                    'value'=>'oldStaff.fio',
                                ],
                                [
                                    'label'=>'Кому',
                                    'attribute'=>'new_staff',
                                    'value'=>function($searchModel){
                                        if(!is_object($searchModel->newStaff)){
                                            return 'Расположен на складе';
                                        }else{
                                            return $searchModel->newStaff->fio;
                                        }
                                    },
                                ],
                                'date',
                                'comment',



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
