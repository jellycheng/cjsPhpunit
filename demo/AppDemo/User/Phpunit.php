<?php
namespace AppDemo\User;

class Phpunit {

    /**
     * 用于提供phpunit测试第1个流程代码
     *
     * 无业务逻辑
     *
     * @param string $str
     * @return string
     */
    public function welcome($str)
    {
        return 'welcome ' . $str;
    }


}