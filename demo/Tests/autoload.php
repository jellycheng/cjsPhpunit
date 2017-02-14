<?php
/**
 * 单元测试入口文件
 */
define('PHPUNIT_TEST_ENV_OVERRIDE', 'test');
date_default_timezone_set('Asia/Shanghai');
$fileAutoload =  dirname(__DIR__)."/bootstrap/autoload.php";
if(file_exists($fileAutoload)) {
    require_once $fileAutoload;
}
require_once dirname(__DIR__) . '/common.php';
if(file_exists(__DIR__ . '/.env')){
    \CjsPhpunit\EnvLoader::load(__DIR__);
}

if(\CjsPhpunit\env('APP_ENV', '') == 'production' || !\CjsPhpunit\env('APP_ENV', '')) {
    $msg = sprintf('不允许在生产环境或者不明确的环境下跑测试用例, 当前APP_ENV=%s', \CjsPhpunit\env('APP_ENV', ''));
    \CjsPhpunit\printInfo($msg);
    exit();
}

$testAppObj = \CjsPhpunit\TestApp::create()->setTestBasePath(__DIR__ . '/')->setFrameWorkType('phpunit');
$testAppObj->setLog(\CjsPhpunit\Log::create())->setPath('logPath', __DIR__ . '/Logs/');

