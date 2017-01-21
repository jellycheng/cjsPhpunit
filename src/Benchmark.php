<?php
namespace CjsPhpunit;
/**
 * 消耗时间
 */

class Benchmark {

    protected static $marker = array();
    protected static $startPrefix = 's_';
    protected static $endPrefix = 'e_';

    /**
     * @param $tag
     */
    public static function start($tag) {
        $name = self::$startPrefix . $tag;
        self::$marker[$name] = microtime(TRUE);
    }

    /**
     *
     * @param $tag
     * @param int $decimals
     * @return string
     */
    public static function elapsed_time($tag, $decimals = 4, $isforce = true) {
        $startName = self::$startPrefix . $tag;
        $endName = self::$endPrefix . $tag;
        if ( ! isset(self::$marker[$startName])) {
            return '';
        }
        if ( ! isset(self::$marker[$endName]) || $isforce) {
            self::$marker[$endName] = microtime(TRUE);
        }
        return number_format(self::$marker[$endName] - self::$marker[$startName], $decimals);

    }


    public static function setEnd($tag) {
        $endName = self::$endPrefix . $tag;
        self::$marker[$endName] = microtime(TRUE);
    }

    public static function getStart($tag) {
        $startName = self::$startPrefix . $tag;
        return isset(self::$marker[$startName])?self::$marker[$startName]:0;
    }

    public static function getEnd($tag) {
        $endName = self::$endPrefix . $tag;
        return isset(self::$marker[$endName])?self::$marker[$endName]:0;
    }

}