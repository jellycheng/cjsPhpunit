<?php
namespace CjsPhpunit;

class TestCaseCount{

    protected static $i=0;

    protected function __construct()
    {

    }

    public static function create()
    {
        static $instance;
        if(!$instance) {
            $instance = new static();
        }
        return $instance;
    }

    public function addI($num = 1)
    {
        $num = intval($num);
        self::$i += $num;
        return $this;
    }

    public function getI()
    {
        return self::$i;
    }

}