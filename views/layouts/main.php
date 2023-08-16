<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\Request;
use app\models\StatusRequest;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Modal;

AppAsset::register($this);


$psyho_request = Request::find()->where(['status_request_id'=>StatusRequest::getStatusRequestId('Новый')])->count();

$user_request = Request::find()->where(['status_request_id'=>StatusRequest::getStatusRequestId('Отвечено'), 'user_id'=> Yii::$app->user->id])->count();;

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '/img/favicon/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo.png', ['alt' => 'Наш логотип', 'class' => 'logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-xxl navbar-dark navbar fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'encodeLabels'=>false,
        'items' => [
            ['label' => 'Психологическая служба колледжа', 'url' => ['/site/index']],
            ['label' => 'Статьи', 'url' => ['/blog']],
            ['label' => 'Тесты', 'url' => ['/testing']],
            Yii::$app->user->isGuest
                 ? ['label' => 'Регистрация', 'url' => ['/site/register']]
                 :'',
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && !Yii::$app->user->identity->isPsycho
                 ? ['label' => 'Вопрос психологу', 'url' => ['/site/request']]
                 :'',
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin && !Yii::$app->user->identity->isPsycho
                 ? ['label' => 'Личный кабинет<button class="btn btn-outline-danger btn-my btn-sm ms-1">'.$user_request.'</button>', 'url' => ['/profile']]
                 :'',
            !Yii::$app->user->isGuest && Yii::$app->user->identity->isPsycho
                 ? ['label' => 'Кабинет психолога <button class="btn btn-outline-danger btn-my btn-sm ms-1">'.$psyho_request.'</button>', 'url' => ['/psycho']]
                 :'',
            !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin
                 ? ['label' => 'Кабинет администратора', 'url' => ['/admin']]
                 :'', 
            Yii::$app->user->isGuest
                ? ['label' => 'Войти', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->login . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0 " role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3">
    <div class="container">
        <div class="row text-muted">
            <div class="col-xl-12 text-center text-md-start">&copy; Психологическая служба СПБ ГБ ПОУ «Радиотехнического колледжа» <?= date('Y') ?> г.</div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
