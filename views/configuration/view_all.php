<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */

$this->title = Html::encode($staff->fio);

?>
<div class="view-all-configurations">
    <h2><?= Html::encode($staff->fio) ?></h2>

    <?= $this->render('/monitors/view', [
        'model' => $monitors,
    ]) ?>

    <?= $this->render('/configuration/view', [
        'model' => $configuration,
    ]) ?>

    <?= $this->render('/printers/view', [
        'model' => $printers,
    ]) ?>



</div>
