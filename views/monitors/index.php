<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchMonitors */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monitors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Monitors', ['create_monitors'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'comment',
           // 'invent_num',
            'date',
            'idMonitor.date',
            'idMonitor.nameMonitor.name',
//            [
//                'attribute'=>'comment',
//                'value'=>'historyDiscarded.comment',
//            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
