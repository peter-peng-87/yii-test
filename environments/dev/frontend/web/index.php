<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
error_reporting(E_ALL);
$_root_path = __DIR__ . '/../../../';
define('PRO_ROOT_PATH', $_root_path);
require($_root_path . 'vendor/autoload.php');
require($_root_path . 'vendor/yiisoft/yii2/Yii.php');
require($_root_path . 'common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');
$test = require($_root_path . 'common/config/main-local.php');

$config = yii\helpers\ArrayHelper::merge(
    require($_root_path . 'common/config/main.php'),
    require($_root_path . 'common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);
$application = new yii\web\Application($config);
$application->run();

