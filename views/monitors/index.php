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

            'id',
            'invent_num',
            'date',
            [
                'attribute'=>'comment',
                'value'=>'historyDiscarded.comment',
            ],
            // 'date_2',
            // 'old_staff_1',
            // 'old_staff_2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
