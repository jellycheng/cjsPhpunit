<?php
namespace TestAppDemo\User;

use CjsPhpunit\TestCaseBase;
/**
 * cd demo/
 * php ../phpunit/phpunit-4.8.31.phar --bootstrap Tests/autoload.php Tests/User/PhpunitTest.php
 */
class PhpunitTest extends TestCaseBase {

    public function testWelcome() {
        $res = $this->invoke('\\AppDemo\\User\\Phpunit.welcome', "cjs");
        $this->assertEquals("welcome cjs", $res);

    }

}