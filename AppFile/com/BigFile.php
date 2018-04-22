<?php



	namespace AppFile\com;

	class BigFile {


		private static $config = ['memory_limit'=>'120M','set_time_limit'=>'0'];

		/**
	     *@param String $file
	     *@param Closure $callfun
	     *@param 
	     *@return Boolean 
	     */
		public static function readFileData($file,$callfun) {

			if(!file_exists($file)) {
				throw new \Exception('File not find');
			}
			if(!($callfun instanceof \Closure)) {
				throw new \Exception('Function Param Error callfun');
			}
                        
			$file_size = filesize($file);
			$file_size_m = round($file_size / 1024 / 1024,2);

			if(true || $file_size_m <= 60) { 
				ini_set('memory_limit',self::$config['memory_limit']);
				$line_data = file($file);
				call_user_func_array($callfun, [$line_data]);
				return true;
			}else {
				//ini_set('memory_limit',self::$config['memory_limit']);
				set_time_limit(self::$config['set_time_limit']);
                                
				$fh = fopen($file,'r');
				while(!feof($fh)) {
					$line = fgets($fh);
					call_user_func_array($callfun, [$line]);
				}
				fclose($fh);
				return true;
			}
			return false;

		}


	}



?>