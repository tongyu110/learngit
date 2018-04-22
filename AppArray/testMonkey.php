<?php
/**
 * User: xpc
 * Date: 2018/4/23
 * Description: PHP数组解决“约瑟夫环”问题
 * 一群猴子排成一圈，按1，2，...，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去...，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。
要求编程模拟此过程，输入m、n, 输出最后那个大王的编号。
 */

function test($n,$m) {

    $data = [];
    for($i=1;$i<=$n;$i++) {
        $data[$i-1] = $i;
    }
    $last = null;
    while(true) {

        $_m = $m;
        while($_m!=0) {
            if(count($data) == 1) { $last = array_pop($data); break; }
            foreach($data as $k=>$v) {
                $_m--;
                if($_m == 0) {
                    unset($data[$k]);
                    break;
                }
            }
        }
        if(!is_null($last)) {
            break;
        }

    }
    return $last;
}

function king($n,$m) {
    $monkey = range(1,$n);	// 模拟建立一个连接数组
    $i = 0;
    while(count($monkey) > 1) {
        $i++; // 开始查数
        $head = array_shift($monkey);	// 直接一个一个出列最前面的猴子
        if($i % $m !=0) {
            array_push($monkey,$head);	// 如果没有数到 m 或 m 的倍数，则把该猴子放回尾部去
        }
    }
    return $monkey[0];
}

echo king(2,10);