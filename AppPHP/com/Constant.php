<?php

	
	namespace AppPHP\com;

	/**
	 * 对 PHP 常量测试
	 */
	class Constant {


		public function testPHPEOL() {

			$content = $_POST['items'];
			$d = explode(PHP_EOL,$content);
			var_dump($d);exit;
                        
		}

		public function output() {

			$html = '
				<form action="" method="post" entype="multipart/form-data">
					<textarea rows="5" cols="30" name="items" class="input-txt" style=" height:100px;"></textarea>
					<input type="submit" value="Submit" />
				</form>';
			echo $html;
		}

	}


?>