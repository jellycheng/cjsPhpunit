<?php
namespace CjsPhpunit;

class Log {

    protected static $_i = 1;

    public static function create() {
        static $instance = null;
        if(is_null($instance)) {
            $instance = new static();
        }
        return $instance;
    }

    public function debugLog() {
        $args   = func_get_args();
        $logPath = TestApp::create()->getPath('logPath');
        if(!$logPath) {
            $logPath = isset($_ENV['APP_TEST_LOG_DIR'])?$_ENV['APP_TEST_LOG_DIR']:'';
        }
        if(!is_dir($logPath)) {
            @mkdir($logPath, 0700, true);
        }
        $filename = sprintf("%sphpunit_%s.log", $logPath, date('Ymd'));
        $time = date('Y-m-d H:i:s');
        $i = self::$_i++;
        if(is_array($args)) {
            $msg = sprintf('========================%s start %s========================%s', $time, $i, PHP_EOL);
            foreach ($args as $k=>$v) {
                if(is_array($v)) {
                    $msg .= "\t" . var_export($v, true);
                } else {
                    $msg .= "\t" . $v;
                }
            }
            $msg .= sprintf('%s========================%s end %s========================%s', PHP_EOL, $time, $i, PHP_EOL);
            file_put_contents($filename, $msg, FILE_APPEND);
        }

    }


    public function __call($name, $arguments)
    {
        return null;
    }

}
