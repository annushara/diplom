<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchRefill */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Refills';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refill-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Refill', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_staff'=>'idPrinter.idStaff.fio',
            [
               'attribute'=>'id_name_printer',
                'value'=>'idPrinter.idNamePrinter.name',
            ],

            'comment:ntext',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
