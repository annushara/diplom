<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchPrinters */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Printers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="printers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Printers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_printer',
            'invent_num_printer_1',
            'invent_num_printer_2',
            'print_1',
            'print_2',
            // 'print_3',
            // 'print_4',
            // 'print_5',
            // 'print_6',
            // 'print_7',
            // 'print_8',
            // 'print_9',
            // 'print_10',
            // 'date_1',
            // 'date_2',
            // 'old_staff_1',
            // 'old_staff_2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
