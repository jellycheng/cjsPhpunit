<?php
namespace TestAppDemo\User;

use CjsPhpunit\TestCaseBase;
/**
 * cd demo/
 * php ../phpunit/phpunit-4.8.31.phar --bootstrap Tests/autoload.php Tests/User/PwdTest.php
 */
class PwdTest extends TestCaseBase {

    /**
     * 获取用户密码用例
     *
     * 场景1 判断密码是否等于固定值
     *
     * 场景2 判断返回的用户id是否正确
     *
     * @author jelly
     */
    public function testGetUserPwd() {

        $userid = 1190;
        $res = $this->invoke('\\AppDemo\\User\\Pwd.getUserPwd', $userid);
        //场景1
        $this->assertEquals("pwd123_" . $userid, \CjsPhpunit\array_get($res, 'pwd', ''));

        //场景2
        $this->assertEquals($userid, \CjsPhpunit\array_get($res, 'userid', ''));

    }


}