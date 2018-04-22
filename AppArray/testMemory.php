<?php
/**
 * User: xpc
 * Date: 2018/4/23
 * Description:
 */

$a = [];
$p = (1 << 14) - 1; // 每一次移动都表示 乘以 2
$b = 1;
for($i=0;$i<$p;$i++) {
    $a[] = $b;
}

echo memory_get_usage(true) . "\n";
$a['as1'] = 1;
echo memory_get_usage(true) . "\n";
$a['as2'] = 1;
echo memory_get_usage(true) . "\n";

// 2097152 2097152 4194304
// 前两次输出都是一次，最后输出在一倍
