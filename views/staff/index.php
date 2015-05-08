<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchStaff */
/* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Все сотрудники';
?>
<div class="staff-index">

    <div class="body-content">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-user  "></i> Все сотрудники
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">


                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'fio',
                            [
                                'attribute'=>'department',
                                'value'=>'idDepartment.department',
                            ],



                            ['class' => 'yii\grid\ActionColumn',
                             'template' => '{update}',
                             'buttons' => [
                                 'update' => function ($url,$model) {
                                     return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                         ['/staff/update', 'id' => $model->id],
                                     [
                                         'title'=>'Редактировать',
                                     ]
                                     );
                                 },

                             ],

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
