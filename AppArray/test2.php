<?php
/**
 * User: xpc
 * Date: 2018/4/24
 * Description:
 */

include "../loader.php";

$arr = [
    ['id'=>1,'age'=>20,'name'=>'abu3'],
    ['id'=>2,'age'=>50,'name'=>'abu4'],
    ['id'=>3,'age'=>15,'name'=>'abu2'],
    ['id'=>4,'age'=>22,'name'=>'abu1'],
];

$new_data = \SevenPHP\Lib\Util\Common::arrayMultiSort($arr,'name');
var_dump($new_data);exit;
