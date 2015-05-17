<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = 'PCinventory';
/*
 *  @var $searchModel  app\models\SearchRefill
 */
?>

  <div class="site-index">

    <div class="body-content">


        <?php Pjax::begin(); ?>
        <div class="body-content">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> Панель задач
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">

                            <table class="table">
                                <?php if($taskMissed):?>
                                <tr>
                                    <td style="color:darkred"><h4><b>Пропущенные не выполненые задачи</b></h4> </td>
                                    <td>
                                        <table class="table">
                                            <?php foreach($taskMissed as $key=>$value):?>

                                                <tr>
                                                    <td style="color: darkred"><b><?=$value->comment?></b></td>
                                                    <td style="text-align: right"><?= Html::a('', ['/site/task-done', 'id'=>$value->id], [
                                                            'class' => 'glyphicon glyphicon-ok',
                                                            'title'=>'Выполнено',
                                                            ])
                                                        ?></td>
                                                </tr>
                                            <?php endforeach?>
                                        </table>
                                    </td>
                                </tr>
                                <?php endif?>



                                <tr>
                                <td><h4><b>Задачи на сегодня</b></h4></td>
                                    <td>
                                        <table class="table">
                                            <?php foreach($taskToday as $key=>$value):?>

                                            <tr>
                                                <td style="color: #337AB7"><b><?=$value->comment?></b></td>
                                                <td style="text-align: right"><?= Html::a('', ['/site/task-done', 'id'=>$value->id], [
                                                        'class' => 'glyphicon glyphicon-ok',
                                                        'title'=>'Выполнено',
                                                        ])
                                                    ?></td>
                                            </tr>
                                            <?php endforeach?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h4><b>Задачи на эту неделю</b></h4></td>
                                    <td>
                                    <table class="table">
                                        <?php foreach($taskWeak as $key=>$value):?>

                                            <tr>
                                                <td style="color: #337AB7"><b><?=$value->comment?></b></td>
                                                <td style="text-align: right"><?= Html::a('', ['/site/task-done', 'id'=>$value->id], [
                                                        'class' => 'glyphicon glyphicon-ok',
                                                        'title'=>'Выполнено',
                                                    ])
                                                    ?></td>
                                            </tr>
                                        <?php endforeach?>
                                    </table>
                                    </td>
                                </tr>




                            </table>
                        </div>
                        <!-- /.list-group -->
                        <div style="float: right">
                            <a href="<?=\yii\helpers\Url::to(['/site/add-task'])?>" class="btn btn-danger" onclick='addTask(this); return false;'>Добавить задачу</a>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <?php Pjax::end(); ?>





        <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm ">
                <div class="modal-content">
                    <div class="modal-body">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

  </div>
