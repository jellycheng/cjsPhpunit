<?php
require_once __DIR__ . '/common.php';
$sqlContent = file_get_contents(__DIR__ . '/Tests/schemas/user_db/schemas.sql');

$sql = \CjsPhpunit\ParseSql::parseSql($sqlContent);
var_export($sql);
echo PHP_EOL;

