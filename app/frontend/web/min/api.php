<?php
/**
 * Front controller for default Minify implementation
 * DO NOT EDIT! Configure this utility via config.php and groupsConfig.php
 * @package Minify
 */
define('MINIFY_MIN_DIR', dirname(__FILE__));
require_once MINIFY_MIN_DIR . '/api.fun.php';
require_once 'D:/wnmp/www/gitapi/cheyiweb/yii/vendor/autoload.php';
$groupConfig = getGroupConfig();
$groupName = $_GET['g'];
$curGroup = $groupConfig[$groupName];
// set config path defaults
$min_configPaths = array(
    'base'   => MINIFY_MIN_DIR . '/config.php',
    'groups' => MINIFY_MIN_DIR . '/groupsConfig.php'
);
// load config
require $min_configPaths['base'];

Minify_Loader::register();

Minify::$uploaderHoursBehind = $min_uploaderHoursBehind;
Minify::setCache(
    isset($min_cachePath) ? $min_cachePath : ''
    ,$min_cacheFileLocking
);
$min_documentRoot =$curGroup['documentRoot'];
if ($min_documentRoot) {
    $_SERVER['DOCUMENT_ROOT'] = $min_documentRoot;
    Minify::$isDocRootSet = true;
}

$min_serveOptions['minifierOptions']['text/css']['symlinks'] = $min_symlinks;
// auto-add targets to allowDirs
foreach ($min_symlinks as $uri => $target) {
    $min_serveOptions['minApp']['allowDirs'][] = $target;
}

if ($min_allowDebugFlag) {
    $min_serveOptions['debug'] = Minify_DebugDetector::shouldDebugRequest($_COOKIE, $_GET, $_SERVER['REQUEST_URI']);
}

if (!empty($min_concatOnly)) {
    $min_serveOptions['concatOnly'] = true;
}
$min_serveOptions['compress'] = true;
if ($min_errorLogger) {
    if (true === $min_errorLogger) {
        $min_errorLogger = FirePHP::getInstance(true);
    }
    Minify_Logger::setLogger($min_errorLogger);
}

// check for URI versioning
if (preg_match('/&\\d/', $_SERVER['QUERY_STRING']) || isset($_GET['v'])) {
    $min_serveOptions['maxAge'] = 31536000;
}
// group config
$min_serveOptions['minApp']['groups'] = getGroupData($groupConfig);
$min_serveOptions['saveFile'] = $curGroup['target'];
// $min_serveOptions['quiet'] = true;
// $min_serveOptions['debug'] = true;
// serve or redirect
if (! isset($min_serveController)) {
    $min_serveController = new Minify_Controller_MinApp();
}
// Minify::setCache(null, $min_cacheFileLocking);
$result = Minify::serve($min_serveController, $min_serveOptions);
        