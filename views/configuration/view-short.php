<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Monitors */
/* @var $staff app\models\Staff */
$this->title = $staff->fio;

/*подключам js скрипт модального окна с формой для того чтоб он действовал только в этом контроллере*/

$this->registerJsFile(
    'yii2/web/js/move.js',
    ['depends'=>'app\assets\AppAsset']
);
?>
<div class="monitors-view">

    <div class="col-lg-12">
    <div class="panel panel-info">
        <div class="panel-heading">
           <b><i class="">Карточка сотрудника</i></b>

                <h6 style="float:right;"> Отметить сотрудника как "уволенный"
                    <a class="fa fa-user-times"
                       title='уволенный'
                       onclick="sendStore(this); return false;"
                       data-staff-id="<?= $staff->id?>"
                       href="#"
                        ></a>
                </h6>
        </div>
        <div class="panel-body">
            <div class="list-group">
                <table class="table">
                    <tr>
                        <th></th>
                        <th>Название</th>
                        <th>Дата поступления</th>
                        <th>Инв №</th>
                    </tr>

                   <tr>
                       <td>Подразделение</td>
                       <td><?= $staff->idDepartment->department?></td>
                       <?php /* $staff->idDepartment->department
                                * idDepartment это магический метод getIdDepartment()
                                * который находится в модели Staff котоорый связывает
                                * таблиц с внишним ключем. Метод возвращает объект класса Department
                                */?>
                    </tr>
                    <tr>
                        <td>ФИО</td>
                        <td><?= $staff->fio ?></td>
                    </tr>
                    <?php if($monitors = $staff->monitors){ //$staff->monitors, тоже магический метод класса Staff,
                        //возвращает все объекты класса Monitors() текущего сотрудника которого выбрали
                            foreach($monitors as $key =>$value): ?>
                                <tr>
                                    <td>Монитор</td>
                                    <td><?=$value->nameMonitor->name //nameMonitor магический метод класа Monitors(), возвращает объект с названием монитора  ?></td>
                                    <td><?=$value->date ?></td>
                                    <td><?=$value->invent_num ?></td>
                                    <td>
                                        <a class="fa fa-archive move-one"
                                           title='переместить на склад'
                                           onclick='sendOneTo(this); return false;'
                                           data-sendto="store"
                                           data-name='monitor'
                                           data-item = "<?= $value->id ;?> "
                                           href="#"
                                            ></a>

                                        <a class="glyphicon glyphicon-export move-one"
                                        title='переместить сотруднику'
                                        onclick='sendOneTo(this); return false;'
                                        data-sendto="staff"
                                        data-name='monitor'
                                        data-item = "<?= $value->id ;?> "
                                        href="#"
                                        ></a>

                                        <a class="glyphicon glyphicon-remove move-one"
                                           title='Списать оборудование'
                                           onclick='destroyEquipment(this); return false;'
                                           data-name='monitor'
                                           data-item = "<?= $value->id ;?> "
                                           href="#"
                                            ></a>
                                     </td>
                                </tr>
                            <?php endforeach?>
                    <?php } // end if?>


                    <?php if($config = $staff->systemUnits){
                        foreach($config as $key =>$value): ?>
                            <tr>
                                <td>Системный блок</td>
                                <td><?=$value->nameSystemUnit->name ?></td>
                                <td><?=$value->date ?></td>
                                <td><?=$value->invent_num ?></td>
                                <td>
                                    <a class="fa fa-archive move-one"
                                       title='переместить на склад'
                                       onclick='sendOneTo(this); return false;'
                                       data-sendto="store"
                                       data-name='units'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"
                                        ></a>

                                    <a class="glyphicon glyphicon-export move-one"
                                       title='переместить сотруднику'
                                       onclick='sendOneTo(this); return false;'
                                       data-sendto="staff"
                                       data-name='units'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"


                                        ></a>

                                    <a class="glyphicon glyphicon-remove move-one"
                                       title='Списать оборудование'
                                       onclick='destroyEquipment(this); return false;'
                                       data-name='units'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"
                                        ></a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    <?php } // end if?>

                    <?php if($print = $staff->printers){
                        foreach($print as $key =>$value): ?>
                            <tr>
                                <td>Принтер</td>
                                <td><?=$value->idNamePrinter->name ?></td>
                                <td><?=$value->date ?></td>
                                <td><?=$value->invent_num ?></td>
                                <td>
                                    <a class="fa fa-archive move-one"
                                       title='переместить на склад'
                                       onclick='sendOneTo(this); return false;'
                                       data-sendto="store"
                                       data-name='printer'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"
                                        ></a>

                                    <a class="glyphicon glyphicon-export move-one"
                                       title='переместить сотруднику'
                                       onclick='sendOneTo(this); return false;'
                                       data-sendto="staff"
                                       data-name='printer'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"
                                        ></a>


                                    <a class="glyphicon glyphicon-remove move-one"
                                       title='Списать оборудование'
                                       onclick='destroyEquipment(this); return false;'
                                       data-name='printer'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"
                                        ></a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    <?php } // end if?>

                    <?php if($other = $staff->others){
                        foreach($other as $key =>$value): ?>
                            <tr>
                                <td><?=mb_convert_case($value->category, MB_CASE_TITLE, "UTF-8") ?></td>
                                <td><?=$value->name ?></td>
                                <td><?=$value->date ?></td>
                                <td><?=$value->invent_num ?></td>
                                <td>
                                    <a class="fa fa-archive move-one"
                                       title='переместить на склад'
                                       onclick='sendOneTo(this); return false;'
                                       data-sendto="store"
                                       data-name='other'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"
                                        ></a>

                                    <a class="glyphicon glyphicon-export move-one"
                                       title='переместить сотруднику'
                                       onclick='sendOneTo(this); return false;'
                                       data-sendto="staff"
                                       data-name='other'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"
                                        ></a>


                                    <a class="glyphicon glyphicon-remove move-one"
                                       title='Списать оборудование'
                                       onclick='destroyEquipment(this); return false;'
                                       data-name='other'
                                       data-item = "<?= $value->id ;?> "
                                       href="#"
                                        ></a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    <?php } // end if?>
                </table>


            </div>
            <!-- /.list-group -->
            <p>
                <?= Html::a('Редактировать', ['/upload/monitors', 'id' => $staff->id], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Печать карточки сотрудника', ['/print/card', 'id' => $staff->id, 'type'=>'card'], [
                    'class' => 'btn btn-primary',
                    'target'=>'_blank',
                    ]) ?>
                <?= Html::a('Печать QR code', ['/print/card', 'id' => $staff->id], [
                    'class' => 'btn btn-primary',
                    'target'=>'_blank',
                ]) ?>

                <?= Html::submitButton('Переместить все',  ['class'=> 'btn btn-danger move', 'id' => $staff->id, ]) ;?>
                <?= Html::a('Добавить заправку', ['/add/add-refill', 'id' => $staff->id], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
    </div>




    <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm ">
            <div class="modal-content">
                <div class="modal-body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>