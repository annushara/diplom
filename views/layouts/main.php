<?php

    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use app\assets\AppAsset;
    use app\components\GetStaff;

    /* @var $this \yii\web\View */
    /* @var $content string */
    /* @var $staff string */

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap ">
    <?php
        /*Зададим виджету меню другой css класс*/
        \Yii::$container->set('yii\bootstrap\NavBar', [
            'innerContainerOptions' => [
                'class' => 'container-fluid',
            ],
        ]);

        NavBar::begin([
            'brandLabel' => 'Главная',
            'brandUrl'   => Yii::$app->homeUrl,
            'options'    => [
                'class' => 'navbar-inverse navbar-fixed-top ',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items'   => [
                ['label' => 'Добавить', 'items' => [
                    ['label' => 'Подразделение', 'url' => ['/add/department']],
                    ['label' => 'Сотрудника', 'url' => ['/add/staff']],
                    ['label' => 'Конфигурацию', 'url' => ['/upload/upload']],
                    ['label' => 'Монитор', 'url' => ['/add/monitor']],
                    ['label' => 'Системный блок', 'url' => ['/add/system-unit']],
                    ['label' => 'Принтер', 'url' => ['/add/printer']],
                    ['label' => 'Другое оборудование', 'url' => ['/add/other']],
                ]],
                ['label' => 'Вид', 'items' => [
                    ['label' => 'Все сотрудники', 'url' => ['/staff/index']],
                    ['label' => 'Уволенные сотрудники', 'url' => ['/staff/staff-destroy']],
                    ['label' => 'Все конфигурации', 'url' => ['/configuration/index']],
                    ['label' => 'Списанные мониторы', 'url' => ['/site/discarded-monitors']],
                    ['label' => 'Списаные системные блоки', 'url' => ['/site/discarded-units']],
                    ['label' => 'Списаные принтеры', 'url' => ['/site/discarded-printers']],
                    ['label' => 'Списаное прочее оборудование', 'url' => ['/site/discarded-others']],

                ]],
                ['label' => 'Инструменты', 'items' => [
                    ['label' => 'Планирование', 'url' => ['/crud-job-result/index']],
                    ['label' => 'Просмотр пермещений ПК', 'url' => ['/crud-job-result/index']],
                ]],
                ['label' => 'Печать', 'items' => [
                    ['label' => 'Акт на списание', 'url' => ['/crud-job-result/index']],
                    ['label' => 'Расходная накладная', 'url' => ['/crud-job-result/index']],
                    ['label' => 'Отчет обеспеченности ПК', 'url' => ['/crud-job-result/index']],
                    ['label' => 'Отчет по сотруднику', 'url' => ['/crud-job-result/index']],
                    ['label' => 'Карточка сотрудника', 'url' => ['/crud-job-result/index']],
                    ['label' => 'QRcode сотрудника', 'url' => ['/crud-job-result/index']],
                ]],
                Yii::$app->user->isGuest ?
                    ['label' => 'Login', 'url' => ['/site/login']] :
                    ['label'       => 'Logout (' . Yii::$app->user->identity->username . ')',
                     'url'         => ['/site/logout'],
                     'linkOptions' => ['data-method' => 'post']],
            ],
        ]);
        NavBar::end();
    ?>

    <div class="navbar-default sidebar" role="navigation">
        <h3 class="text-center">Сотрудники</h3>

        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <?= GetStaff::widget() ?>

            </ul>


        </div>
        <!-- /.sidebar-collapse -->
    </div>

    <div id="page-wrapper">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>

    </div>


</div>

<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
