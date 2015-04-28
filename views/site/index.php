<?php
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'PCinventory';
/*
 *  @var $searchModel  app\models\SearchRefill
 */
?>

  <div class="site-index">

    <div class="body-content">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-import "></i> Приходы
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">

                    </div>
                    <!-- /.list-group -->
                    <a href="#" class="btn btn-default btn-block">Все приходы</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-export "></i> Расходы
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">

                    </div>
                    <!-- /.list-group -->
                    <a href="#" class="btn btn-default btn-block">Все расходы</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-archive  "></i> Остаток на складе
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">

                    </div>
                    <!-- /.list-group -->
                    <a href="#" class="btn btn-default btn-block">Показать остатки</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class=" glyphicon glyphicon-print" ></i> Заправка картриджей
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-condensed ">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'summary'=>'',
                            'showFooter'=>true,
                            'showHeader' => true,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute'=>'fio',
                                    'value'=>function($searchModel){
                                        if(!is_object($searchModel->idPrinter->idStaff)){
                                            return 'Отправлен на склад';
                                        }else{
                                            return $searchModel->idPrinter->idStaff->fio;
                                        }
                                    },
                                ],
                                [
                                    'attribute'=>'name',
                                    'value'=>'idPrinter.idNamePrinter.name',
                                ],
                                'comment:ntext',
                                'date',


                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{delete}',
                                    'buttons' => [
                                        'delete' => function ($url,$model) {
                                            return Html::a('<span class="glyphicon glyphicon-remove"></span>',
                                                ['/configuration/delete_refill', 'id' => $model->id],
                                                [
                                                    'data' => [
                                                        'confirm' => 'Вы действительно хотите удалить эту запись',
                                                        'method' => 'post',
                                                    ],
                                                    ]
                                            );
                                        },
                                    ],
                                ],
                            ],
                            'tableOptions' =>['class' => 'table table-striped table-bordered table-condensed '],

                        ]); ?>
                    </div>
                    <!-- /.list-group -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>


        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Панель уведомлений
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i> New Comment
                        <span class="pull-right text-muted small"><em>4 minutes ago</em>
                        </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                        <span class="pull-right text-muted small"><em>12 minutes ago</em>
                        </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                        <span class="pull-right text-muted small"><em>27 minutes ago</em>
                        </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> New Task
                        <span class="pull-right text-muted small"><em>43 minutes ago</em>
                        </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                        <span class="pull-right text-muted small"><em>11:32 AM</em>
                        </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                        <span class="pull-right text-muted small"><em>11:13 AM</em>
                        </span>

                    </div>
                    <!-- /.list-group -->
                    <a href="#" class="btn btn-default btn-block">Показать все уведомления</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>




  </div>
