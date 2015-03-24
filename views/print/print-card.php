
<?php

use yii\helpers\Html;


?>

<div class="monitors-view">
<table width="100%">
    <tr>
        <td><h4><b>ЗАО "РП "Бендерский машиностроительный завод"</b></h4></td>
        <td class="barcodecell" rowspan="4"><barcode code="<?=Html::encode($qrcode) ?>" type="QR" class="barcode" size="1.3" error="M" /></td>
    </tr>
    <tr>
    <td><h4><b>Карточка сотрудника </b></h4></td>
    </tr>
    <tr>
        <td><h5><b>Подразделение:</b> <i><?= $department->department?></i></h5></td>
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


                        <?php if( is_object($monitors)): // проверяем является ли переменная объектом, если нет значит этой конфигурации нет?>
                            <tr>
                                <td>Монитор</td>
                                <td><?=$monitors->monitor_1 ?></td>
                                <td style="text-align: center"><?=$monitors->date_1 ?></td>
                                <td style="text-align: center"><?=$monitors->invent_num_monitor_1 ?></td>
                            </tr>

                            <?php if( $monitors->monitor_2): // проверяем есть ли втророй монитор, если есть выводим?>
                                <tr>
                                    <td>Монитор 2</td>
                                    <td><?=$monitors->monitor_2 ?></td>
                                    <td style="text-align: center"><?=$monitors->date_2 ?></td>
                                    <td style="text-align: center"><?=$monitors->invent_num_monitor_2 ?></td>
                                </tr>
                            <?php endif?>
                        <?php endif?>


                        <?php if(is_object($brief_conf)) :?>
                            <tr>
                                <td>Конфигурация</td>
                                <td><?= $brief_conf->title ?></td>
                                <td style="text-align: center"><?=$configuration->date ?></td>
                                <td style="text-align: center"><?=$configuration->invent_num_system ?></td>
                            </tr>
                        <?php endif?>

                        <?php if(is_object($printers)) {
                            for ($i = 1; $i <= 5; $i++) { //для того чтоб не выводить пустые строки принтеров запустим цикл
                                if (!empty($printers['print_' . $i])) {//проверим не пустой ли ключ массива если нет, выводим
                                    echo '<tr><td>Принтер ' . $i . '</td>'; //выводим заголовок
                                    echo '<td>' . $printers['print_' . $i] . '</td>'; //название принтера
                                    echo '<td style="text-align: center">' . $printers['date_' . $i] . '</td>'; //дата поступления
                                    echo '<td style="text-align: center">' . $printers['invent_num_printer_' . $i] . '</td></tr>'; //инвентарный номер
                                }
                            }
                        }?>


                    </table>
<div class="date" style="display: inline-block"><?= date('d.m.Y');?>
   <div style="display: inline-block"><i>___________ (подпись)</i></div>
    </div>
</div>