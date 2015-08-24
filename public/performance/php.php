<?php
/**
 * 测试PHP执行效率
 */
$start = microtime();
function f()
{
//    $a = 1;
//    $b = 3;
//    $c = $a + $b;
//    return $c;
}

for ($i = 0; $i < 1000; $i++) {
    f();
}
$end = microtime();

echo $end - $start;