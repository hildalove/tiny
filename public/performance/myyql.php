<?php
/**
 * 测试mysql性能
 */

// 写能的性能
require '../../int.inc.php';
$db = \Tiny\Service\Factory::getDatabase();
$start = microtime();
$sql = 'INSERT INTO user SET username = ?, email = ?';

for ($i = 0; $i < 10000; $i ++){
    $db->exec($sql, 'Michael', 'keke231@qq.com');
}

$end = microtime();
echo $start;
echo "\n";
echo $end ;
echo "\n";
echo round($end - $start, 2);
echo "\n";

