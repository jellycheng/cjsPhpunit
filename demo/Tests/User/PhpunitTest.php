<?php
namespace TestAppDemo\User;

use CjsPhpunit\TestCaseBase;
/**
 * cd demo/
 * php ../phpunit/phpunit-4.8.31.phar --bootstrap Tests/autoload.php Tests/User/PhpunitTest.php
 */
class PhpunitTest extends TestCaseBase {

    /**
     * 测试phpunit环境是否Ok用例
     *
     * 场景1 测试环境是否ok
     * @author jelly
     */
    public function testWelcome() {
        $res = $this->invoke('\\AppDemo\\User\\Phpunit.welcome', "cjs");
        $this->assertEquals("welcome cjs", $res);

    }


    /**
     * Hello world 用例
     *
     * 场景1 返回hello world
     * @author jelly
     */
    public function testHelloWorld() {
        $res = $this->invoke('\\AppDemo\\User\\Phpunit.helloWorld');
        $this->assertEquals("hello world", $res);

    }

}