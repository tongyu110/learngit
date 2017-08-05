<?php


	//http://www.cnblogs.com/zcy_soft/archive/2011/04/12/2013223.html

	ini_set('memory_limit','100M');
	function test1() {

		$d = str_repeat('1',10);
		$m = memory_get_usage();
		echo $m."<br/>";
		unset($d);
		$mm = memory_get_usage();
		echo $m - $mm;
	}

	test1();




?>