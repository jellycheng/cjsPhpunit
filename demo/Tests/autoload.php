<?php
/**
 * 单元测试入口文件
 */
define('PHPUNIT_TEST_ENV_OVERRIDE', 'test');
$fileAutoload =  dirname(__DIR__)."/bootstrap/autoload.php";
if(file_exists($fileAutoload)) {
    require_once $fileAutoload;
}
require_once dirname(__DIR__) . '/common.php';

if(\CjsPhpunit\env('APP_ENV', '') == 'production' || !\CjsPhpunit\env('APP_ENV', '')) {
    //exit('不允许在生产环境或者不明确的环境下跑测试用例, 当前APP_ENV=' . \CjsPhpunit\env('APP_ENV', '') . PHP_EOL);
}

\CjsPhpunit\TestApp::create()->setTestBasePath(__DIR__ . '/')->setFrameWorkType('phpunit');


