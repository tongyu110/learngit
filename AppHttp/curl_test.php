<?php


	define('EXT', '.php');
	define('DS', DIRECTORY_SEPARATOR);
	define('APP_PATH', realpath(__DIR__.'/..'));
	defined('SEVEN_PATH') or define('SEVEN_PATH', realpath(__DIR__.'/..') . DS);
	define('CORE_PATH', SEVEN_PATH . 'SevenPHP' . DS);


	require CORE_PATH . 'Loader.php';
	\seven\Loader::register();

	use AppHttp\com\CurlHttp;

	$req_url = 'http://www.php.me/AppHttp/test1.php';
	$con = CurlHttp::fsockopenAnalogUserRequest($req_url,'post',array('id'=>1));
	echo $con;


?>