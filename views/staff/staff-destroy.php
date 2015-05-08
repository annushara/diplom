<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\widgets\Pjax;

    /* @var $this yii\web\View */
    /* @var $searchModel app\models\SearchStaff */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    $this->title = 'Уволенные';
?>
<div class="staff-index">

    <div class="body-content">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user-times  "></i> Уволенные сотрудники
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'summary'=>'',
                            'showFooter'=>true,
                            'showHeader' => true,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'fio',
                                [
                                    'attribute'=>'department',
                                    'value'=>'idDepartment.department',
                                ],



                                ['class' => 'yii\grid\ActionColumn',
                                 'template' => '{delete}',
                                 'buttons' => [
                                     'delete' => function ($url,$model) {
                                         return Html::a('<span class="glyphicon glyphicon-ok"></span>',
                                             ['/configuration/restore-staff', 'id' => $model->id],
                                             [
                                                 'title'=>'Восстановить сотрудника',
                                                 'data' => [
                                                     'confirm' => 'Сотрудник будет восстановлен в преждней должности',
                                                     'method' => 'post',
                                                     'params' => [
                                                         'id' => $model->id

                                                          ],
                                                 ],
                                             ]
                                         );
                                     },
                                 ],
                                ],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>

                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

</div>