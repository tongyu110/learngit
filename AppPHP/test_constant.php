<?php

		define('EXT', '.php');
		define('DS', DIRECTORY_SEPARATOR);
		define('APP_PATH', realpath(__DIR__.'/..'));
		defined('SEVEN_PATH') or define('SEVEN_PATH', realpath(__DIR__.'/..') . DS);
		define('CORE_PATH', SEVEN_PATH . 'SevenPHP' . DS);

		require CORE_PATH . 'Loader.php';
		\seven\Loader::register();

		use AppPHP\com\Constant;

		$constant = new Constant();
		

		if(empty($_POST)) {
			$constant->output();
		}else {
			$constant->testPHPEOL();
		}


?>