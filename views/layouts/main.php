<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400&amp;display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100" style="font-family: 'Noto Sans Thai', sans-serif;">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'SMOG-Epinorth',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => [
            // ['label' => 'นำเข้า', 'url' => ['/upload/index']],
            ['label'=>'รายงานหมอกควัน','url'=>['report/index'],],
            ['label'=>'กิจกรรมหมอกควัน','url'=>['/activity/index']],
            [
                'label' => 'Download',
                'url' => '#',
                'items'=>[
                    ['label'=>'ตัวอย่างไฟล์ CSV','url'=>'documents/11138.csv','linkOptions'=>['target'=>'_blank']],
                    ['label'=>'โครงสร้างไฟล์ CSV','url'=>'documents/datastuc.pdf','linkOptions'=>['target'=>'_blank']],
                ],
            ],[
                'label'=>'Access Token',
                'url'=>['auth/index'],
                'visible'=>!Yii::$app->user->isGuest,
            ],
            ['label' => 'รายงาน 4 มาตรการ', 'url' => 'https://epinorth.ddc.moph.go.th'],
            ['label' => 'Dashboard', 'url' => ['/site/dashboard']],
            ['label' => 'เกี่ยวกับระบบ', 'url' => ['/site/about']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->hospname . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container mt-4">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; สำนักงานป้องกันควบคุมโรคที่ 1 เชียงใหม่ <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end">Developer By CM-Health Team.</div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<style>
/* Customizing the main layout */
body {
    font-family: 'Noto Sans Thai', sans-serif;
}

header {
    background: linear-gradient(90deg, #007bff, #00d4ff);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.navbar-dark .navbar-nav .nav-link {
    color: #fff;
}

.navbar-dark .navbar-nav .nav-link:hover {
    color: #ffeb3b;
}

.navbar-dark .navbar-brand {
    font-weight: bold;
}

footer {
    background: #f8f9fa;
    padding: 20px 0;
}

footer .container {
    max-width: 1200px;
    margin: auto;
}

footer .row div {
    margin: 10px 0;
}

#main {
    /* margin-top: 20px; */
    /* padding: 20px 0; */
}

.container {
    max-width: 1200px;
    margin: auto;
}

h1 {
    font-size: 28px;
    color: #007bff;
    text-align: center;
    margin-bottom: 20px;
}

.btn-success, .btn-primary {
    margin-right: 10px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.panel {
    background-color: #f0f5fa;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px;
    margin-bottom: 20px;
}

.panel-heading {
    background-color: #00bfa5;
    color: #fff;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    font-size: 1.25rem;
    text-align: center;
    font-weight: bold;
}

.panel-footer {
    background-color: #e3f2fd;
    border-top: 1px solid #dee2e6;
    padding: 10px;
    text-align: center;
}

.panel-content {
    padding: 20px;
}

/* Customizing the select box */
.select2-container--default .select2-selection--single {
    border: 1px solid #ced4da;
    border-radius: 4px;
    padding: 6px 12px;
    height: 38px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 24px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
}

.pagination {
    display: flex;
    justify-content: center;
    padding: 20px 0;
}

.page-selector {
    display: inline-block;
    margin: 0 10px;
}

.page-selector select {
    width: 60px;
    padding: 5px;
    border-radius: 4px;
    border: 1px solid #ddd;
}
</style>
