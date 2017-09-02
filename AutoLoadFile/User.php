<?php

namespace AutoLoadFile;

define('EXT', '.php');
define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH', realpath(__DIR__.'/..'));
defined('SEVEN_PATH') or define('SEVEN_PATH', realpath(__DIR__.'/..') . DS);
define('CORE_PATH', SEVEN_PATH . 'SevenPHP' . DS);


require CORE_PATH . 'Loader.php';
\seven\Loader::register();

//include ('E:\xampp-7\htdocs\www.php.me\AutoLoadFile\lib\Order.php');


$type = 'location';
switch($type) {

	case 'text':
	case 'voice':
		$v = 'com';
		break;
	case 'location':
		$v = 'locat';
		break;			
}
echo isset($v)?$v:'';
exit;

use AutoLoadFile\lib\Order;

if(!class_exists('AutoLoadFile\lib\Order')) {
	die('dfdf');
}

$re = call_user_func_array(array('AutoLoadFile\lib\Order', 'show_list'),array());
echo $re;
exit;
$o = new Order();

exit;


//直接载入Order
#include('Order.php');
//自动载入
//define('LIB_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
//spl_autoload_register(function ($class) {echo $class;
     //$path = LIB_DIR . $class . '.lib.php'; 
     //include ($path);
 //});
 
 //spl_autoload_call('Order');
 //use lib\OrderList as lll;
 //use lib\Order;


//$orderList = new lll();
 //$orderList->show_list();


//\Order\TestSatic::display1();


//自动装载库有以下函数
//spl_autoload_call：尝试调用所有已注册的__autoload()函数来装载请求类
 
//注意：
//当采用SPL载入文件时，use并不能触发spl_autoload_register函数，
//他会被new触发，这样就会提示找不到文件，
//所有采用spl_autoload_call 来提前触发自动载入。
 
// 如果不使用 spl_autoload_call 提前载入 Order ，那只有到 new /Order/Orderlist 时自动载入
// 如果这里 new /Order/Orderlist 自动载入，文件查找出错
// \autoload\lib\Order\Orderlist.lib.php 文件不存在
 
 
?>