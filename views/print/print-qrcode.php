
<?php

use yii\helpers\Html;


?>

<div class="monitors-view">



    <table  class="table" width="100%">
        <tr>

        <?php if( is_object($monitors)): // проверяем является ли переменная объектом, если нет значит этой конфигурации нет?>

            <td>
                <table  class="table" width="100%">
                    <tr>
                <th>Монитор 1</th>
                    </tr>
                    <tr>
                        <td class="barcodecell" ><barcode code="<?=Html::encode(
                                $monitors->monitor_1 .
                                ' Дата ' .$monitors->date_1 .
                                ' инв№ ' .$monitors->invent_num_monitor_1
                            ) ?>" type="QR" class="barcode" size="1.3" error="M" /></td>
                    </tr>
                </table>
            </td>
        <?php if( $monitors->monitor_2): // проверяем есть ли втророй монитор, если есть выводим?>
            <td>
                <table  class="table" width="100%">
                    <tr>
                        <th>Монитор 2</th>
                    </tr>
                    <tr>
                        <td class="barcodecell" ><barcode code="<?=Html::encode(
                                $monitors->monitor_1 .
                                ' Дата ' .$monitors->date_1 .
                                ' инв№ ' .$monitors->invent_num_monitor_1
                            ) ?>" type="QR" class="barcode" size="1.3" error="M" /></td>
                    </tr>
                </table>
            <td>
            <?php endif?>
        <?php endif?>


        <?php if(is_object($brief_conf)) :?>
            <td>
                <table  class="table" width="100%">
                    <tr>
                        <th>Конфигурация</th>
                    </tr>
                    <tr>
                        <td class="barcodecell" ><barcode code="<?=Html::encode(
                                $brief_conf->title .
                                ' Дата ' .$configuration->date .
                                ' инв№ ' .$configuration->invent_num_system
                            ) ?>" type="QR" class="barcode" size="1.3" error="M" /></td>
                    </tr>
                </table>
            </td>

        <?php endif?>
        <tr>
        <?php if(is_object($printers)) {

    echo '<tr>';
            for ($i = 1; $i <= 5; $i++) { //для того чтоб не выводить пустые строки принтеров запустим цикл
                if (!empty($printers['print_' . $i])) {//проверим не пустой ли ключ массива если нет, выводим

                    echo '<td><table  class="table" width="100%">';
                   echo '<tr><th>Принтер ' . $i . '</th></tr>'; //выводим заголовок
                    echo '<tr><td class="barcodecell" ><barcode code="' . Html::encode(
                        $printers['print_' . $i] .
                        ' Дата ' .$printers['date_' . $i] .
                        ' инв№ ' .$printers['invent_num_printer_' . $i])
                        . '" type="QR" class="barcode" size="1.3" error="M" /></td></tr></table></td>';

                }
            }
          echo '</tr>';
        }?>


    </table>

</div>