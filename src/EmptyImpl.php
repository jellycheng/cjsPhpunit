<?php
namespace CjsPhpunit;
/**
 * 空实现
 */
class EmptyImpl{

    public static function create()
    {
        static $instance = null;
        if(is_null($instance)) {
            $instance = new static();
        }
        return $instance;
    }

    public function __call($method, $args) {
        return null;
    }

}
