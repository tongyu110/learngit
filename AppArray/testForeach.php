<?php
/**
 * User: xpc
 * Date: 2018/4/22
 * Description: 数组 Foreach 使用引用
 */

$arr = [0,1,2,3];
foreach($arr as &$v) {

}

foreach($arr as $v) {
    echo $v."<br/>";
}

//$v = &$arr[3] = $arr[0] = 0; 此时 $arr[3] = 0
//$v = &$arr[3] = $arr[1] = 1; 此时 $arr[3] = 1
//$arr[3] = 2;
//$arr[3] = 2;
