<?php
    use yii\grid\GridView;
    use yii\helpers\Html;





?>
<div class="col-lg-12">
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
                                    return 'Расположен на складе';
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



