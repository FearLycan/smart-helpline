<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Smart-Helpline Admin Panel',
        'brandUrl' => ['user/index'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems[] = ['label' => 'Users', 'url' => ['user/index']];
    $menuItems[] = ['label' => 'Categories', 'url' => ['category/index']];
    $menuItems[] = ['label' => 'Files', 'url' => ['file/index']];
    $menuItems[] = ['label' => 'Contracts', 'url' => ['contract/index']];

    if (!Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->lastname,
            'options' => ['class' => 'hover'],
            'items' => [
                ['label' => 'Home Page', 'url' => ['/site/index']],
                ['label' => 'Admin panel', 'url' => ['/admin/user/index']],
                '<li class="divider"></li>',
                ['label' => 'Logout',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post'],
                ],
            ]
        ];
    }


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Smart-Helpline Admin Panel <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<?= $this->blocks['script'] ?>

</body>
</html>
<?php $this->endPage() ?>
