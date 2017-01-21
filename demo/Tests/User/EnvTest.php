<?php
namespace TestAppDemo\User;

use CjsPhpunit\TestCaseBase;
use CjsPhpunit\TestApp;
/**
 * cd demo/
 * php ../phpunit/phpunit-4.8.31.phar --bootstrap Tests/autoload.php Tests/User/EnvTest.php
 */
class EnvTest extends TestCaseBase {

    /**
     * 获取phpunit.xml中设置的env值
     *
     * 场景1 监测phpunit.xml文件中配置的php env值不是生产环境代号
     *
     * @author jelly
     */
    public function testEnv() {
        //\CjsPhpunit\printInfo($_ENV);
        TestApp::create()->getLog()->debugLog($_ENV);

        //场景1
        $this->assertTrue(\CjsPhpunit\array_get($_ENV, 'APP_TEST_ENV', 'production') != 'production');

    }


}