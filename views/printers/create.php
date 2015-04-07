<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model app\models\Printers */

$this->title = 'Добавление принтеров';

?>
<div class="printers-create">

    <h2>Добавление принтеров</h2>

    <?= $this->render('_form', [
        'model' => $model,
        'modelName'=> $modelName,
        'listData'=>$listData,
    ]) ?>

</div>
