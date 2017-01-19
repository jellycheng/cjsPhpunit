<?php
namespace AppDemo\User;

class Pwd {

    /**
     * 获取用户密码
     * @param int $userid
     */
    public function getUserPwd($userid) {

        return ['userid'=>$userid, 'pwd'=>'pwd123_' . $userid];
    }


}