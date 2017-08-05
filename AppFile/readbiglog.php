<?php


	define('EXT', '.php');
	define('DS', DIRECTORY_SEPARATOR);
	define('APP_PATH', realpath(__DIR__.'/..'));
	defined('SEVEN_PATH') or define('SEVEN_PATH', realpath(__DIR__.'/..') . DS);
	define('CORE_PATH', SEVEN_PATH . 'SevenPHP' . DS);


	require CORE_PATH . 'Loader.php';
	\seven\Loader::register();

	use AppFile\com\BigFile;

	$file = 'E:\xampp-7\htdocs\www.php.me\access.log';
	
	try{

		BigFile::readFileData($file,function($line){

			if(is_array($line)) {

				var_dump($line);

				
			}else {
				echo $line."\n\r";
			}
			
		});

	}catch(\Exception $e) {

		echo $e->getMessage();

	}



?>