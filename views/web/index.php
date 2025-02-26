<?php

// Comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// Load environment variables from .env file
require __DIR__ . '/../vendor/autoload.php'; // Adjust the path as needed
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); // Adjust the path as needed
$dotenv->load();

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
