<?php
require_once __DIR__ . '/common.php';
$dbConfig = include __DIR__ . '/dbcfg.php';

use CjsPhpunit\Db\MySqlConnector;
$pdoObj = MySqlConnector::create()->connect($dbConfig);
var_export($pdoObj);

$sql = "create database `test_user_db`";
$pdoObj->exec($sql);
if ($pdoObj->errorCode() && $pdoObj->errorCode()!="00000") {
    echo PHP_EOL . "sql error: $sql" . PHP_EOL;
    var_dump($pdoObj->errorInfo());
    echo 'fail' . PHP_EOL;
} else {
    echo 'ok' . PHP_EOL;
}

/**
show databases like 'db_user';
drop database if exists test_db_user;
create database test_db_user;
truncate 表名;
$sql = "INSERT INTO {$table_name} ({$keys_list}) VALUES ({$params_list})";
select version() as version
 *
 */