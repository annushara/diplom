
<?php

    use yii\helpers\Html;
/* @var $staff app\models\Staff */
    /* @var $value app\models\Staff */

?>

<div class="monitors-view">

    <br>
    <h4 style="text-align: center"><b>Отчет обеспеченности персональными компьютерами и
                                      печатной техникой сотрудников
                                      ЗАО "РП "БМЗ"</b></h4>

    <table border="1" class="table" width="100%">


        <tr>
            <th>Фио сотрудника</th>
            <th>Монитор</th>
            <th>Кол-во</th>
            <th>Системный <br> блок</th>
            <th>Кол-во</th>
            <th>Принтер</th>
            <th>Кол-во</th>
        </tr>


        <?php
            foreach($staff->find()->all() as $key =>$value): ?>
                <tr>

                    <td><?=$value->fio ?></td>
                    <td><?=$value->getCountMonitors($value->id) ? 'есть': 'нет' ?></td>
                    <td><?=$value->getCountMonitors($value->id)  ?></td>
                    <td><?=$value->getCountUnits($value->id) ? 'есть': 'нет' ?></td>
                    <td><?=$value->getCountUnits($value->id)  ?></td>
                    <td><?=$value->getCountPrinters($value->id) ? 'есть': 'нет' ?></td>
                    <td><?=$value->getCountPrinters($value->id)  ?></td>

                </tr>
            <?php endforeach?>




    </table>

</div>