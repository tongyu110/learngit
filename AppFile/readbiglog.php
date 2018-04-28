<?php

    include "../loader.php";
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