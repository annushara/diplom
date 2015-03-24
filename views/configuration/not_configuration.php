<?php

use yii\helpers\Html;


?>
<div class="not-configuration-view">

    <h3> У сотрудника: <?=Html::encode($fio)?> конфигурация не назначена!</h3>

    <p>
        <?= Html::a('Назначить конфигурацию', ['assign', 'id' => $staff], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Загрузить конфигурацию', ['upload/upload', 'id' => $staff], ['class' => 'btn btn-success']) ?>
    </p>



</div>