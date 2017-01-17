<?php
$vendorFile = dirname(__DIR__)  .  '/vendor/autoload.php';
if(file_exists($vendorFile)) {
    require $vendorFile;
} else {
    require_once dirname(__DIR__) . '/src/Helpers.php';
    spl_autoload_register(function ($class) {
        $ns = 'CjsPhpunit';
        $base_dir = dirname(__DIR__) . '/src';
        $prefix_len = strlen($ns);
        if (substr($class, 0, $prefix_len) !== $ns) {
            return;
        }
        $class = substr($class, $prefix_len);
        $file = $base_dir .str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if (is_readable($file)) {
            require $file;
        }
    });
}