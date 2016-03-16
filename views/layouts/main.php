<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
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
        'brandLabel' => "<img src='/images/herb.jpg'><img src='/images/flag-text.jpg'>Contact Manager",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
echo Nav::widget([
    'options' => ['class'=> 'navbar-nav'],
    'items' => [
        (Yii::$app->controller->action->id != 'index') ?
            [
                'label' => Html::img('@web/images/home.png', ['id' => 'home-image']).'Home',
                'encode'=>false,
                'url' => Url::to(['/records/index']),
                'options'=>['id'=>'nav-home']
            ]
            :
            [
                'label' => Html::img('@web/images/home.png', ['id' => 'home-image']).'Event',
                'encode'=>false,
                'url' => Url::to(['/records/emails']),
                'options'=>['id'=>'nav-event']
            ],

        Yii::$app->user->isGuest ?
            [
                'label' => Html::img('@web/images/login.png', ['id' => 'login-image']).'Login',
                'url' => Url::to(['/users/login']),
                'options'=>['id'=>'nav-login'],
                'encode'=>false,
            ]
            :
            [
                'label' => 'Logged as: ' . Yii::$app->user->identity->username,
                'options'=>['id'=>'nav-status'],
                'active'=>false,
            ],

        Yii::$app->user->isGuest ?
            [
                'label' => Html::img('@web/images/registrate.png', ['id' => 'registrate-image']).'Registrate','encode'=>false,'url' => Url::to(['/users/registration']),
                'options'=>['id'=>'nav-registration'],
            ]
            :
            [
                'label' => Html::img('@web/images/logout.png').'Logoff',
                'encode'=>false,
                'url' => ['/users/logout'],
                'linkOptions' => ['data-method' => 'post'],
                'options'=>['id'=>'nav-logout'],
            ],
    ]
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
        &copy; Wise Engineering <?= date('Y') ?>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
