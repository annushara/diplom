
<?php

    use yii\helpers\Html;
    /* @var $settings app\models\Settings */

?>

<div class="monitors-view">

    <h4 style="text-align: center"><b>Акт на списание с основных средств <?= $settings->findOne('1')->title?></b></h4>

    <table border="1" class="table" width="100%">


        <tr>
            <th>Тип</th>
            <th>Наименование</th>
            <th>Дата<br>поступления</th>
            <th>Дата<br>списания</th>
            <th>Инв №</th>
            <th>Причина<br>списания</th>
        </tr>


        <?php if($monitors){ //$staff->monitors, тоже магический метод класса Staff,
            //возвращает все объекты класса Monitors() текущего сотрудника которого выбрали
            foreach($monitors as $key =>$value): ?>
                <tr>
                    <td>Монитор</td>
                    <td><?=$value->idMonitor->nameMonitor->name //nameMonitor магический метод класа Monitors(), возвращает объект с названием монитора  ?></td>
                    <td><?=$value->idMonitor->date ?></td>
                    <td><?=$value->date ?></td>
                    <td><?=$value->idMonitor->invent_num ?></td>
                    <td><?=$value->comment ?></td>
                </tr>
            <?php endforeach?>
        <?php } // end if?>


        <?php if($units){
            foreach($units as $key =>$value): ?>
                <tr>
                    <td>Системный блок</td>
                    <td><?=$value->idSystemUnit->nameSystemUnit->name ?></td>
                    <td><?=$value->idSystemUnit->date ?></td>
                    <td><?=$value->date ?></td>
                    <td><?=$value->idSystemUnit->invent_num ?></td>
                    <td><?=$value->comment ?></td>
                </tr>
            <?php endforeach?>
        <?php } // end if?>

        <?php if($printers){
            foreach($printers as $key =>$value): ?>
                <tr>
                    <td>Принтер</td>
                    <td><?=$value->idPrinter->idNamePrinter->name ?></td>
                    <td><?=$value->idPrinter->date ?></td>
                    <td><?=$value->date ?></td>
                    <td><?=$value->idPrinter->invent_num ?></td>
                    <td><?=$value->comment ?></td>
                </tr>
            <?php endforeach?>
        <?php } // end if?>

        <?php if($others){
            foreach($others as $key =>$value): ?>
                <tr>
                    <td><?=mb_convert_case($value->idConfiguration->category, MB_CASE_TITLE, "UTF-8") ?></td>
                    <td><?=$value->idConfiguration->name ?></td>
                    <td><?=$value->idConfiguration->date ?></td>
                    <td><?=$value->date ?></td>
                    <td><?=$value->idConfiguration->invent_num ?></td>
                    <td><?=$value->comment ?></td>
                </tr>
            <?php endforeach?>
        <?php } // end if?>


    </table>
    <div class="date" style="display: inline-block"><?= date('d.m.Y');?>
        <div style="display: inline-block"><i><?= $settings->findOne('1')->name?>___________ (подпись)</i></div>
    </div>
</div>