<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Printers */

$this->title = 'Update Printers';

?>
<div class="printers-update">

    <h1>Обновление конфигурации принтеров</h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
