
<?php

use yii\helpers\Html;

/* @var $settings app\models\Settings */
?>

<div class="monitors-view">
<table width="100%">
    <tr>
        <td><h4><b><?php if ($title=$settings->findOne('1')) echo $title->title; ?></b></h4></td>

    </tr>
    <tr>
    <td><h4><b>Карточка сотрудника </b></h4></td>
    </tr>
    <tr>
        <td><h5><b>Подразделение:</b> <i><?= $staff->idDepartment->department?></i></h5></td>
    </tr>
    <tr>
        <td><h5><b>ФИО: </b> <i><?= $staff->fio ?></i></h5></td>
    </tr>
</table>
                    <table border="1" class="table" width="100%">


                        <tr>
                            <th>Тип</th>
                            <th>Наименование</th>
                            <th>Дата<br>поступления</th>
                            <th>Инв №</th>
                        </tr>


                        <?php if($monitors = $staff->monitors){ //$staff->monitors, тоже магический метод класса Staff,
                            //возвращает все объекты класса Monitors() текущего сотрудника которого выбрали
                            foreach($monitors as $key =>$value): ?>
                                <tr>
                                    <td>Монитор</td>
                                    <td><?=$value->nameMonitor->name //nameMonitor магический метод класа Monitors(), возвращает объект с названием монитора  ?></td>
                                    <td><?=$value->date ?></td>
                                    <td><?=$value->invent_num ?></td>
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
                                </tr>
                            <?php endforeach?>
                        <?php } // end if?>


                    </table>
<div class="date" style="display: inline-block"><?= date('d.m.Y');?>
   <div style="display: inline-block"><i>___________ (подпись)</i></div>
    </div>
</div>