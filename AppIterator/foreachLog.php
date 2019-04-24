<?php


// 通过传递文件名，进行遍历日志内容
// 
// 使用技术点
/*
 * 首选们需要可以遍历功能，对日志内容，逐行读取
 */


class AccessLogIterator extends Countable,Iterator {

	private $lineCount = 0;
	private $fb = null;
	priate $filename = '';

	public function __construct($file) {

		$this->filename = $file;
		$this->init();

	}

	public function __desctruct() {

	}

	public function init() {

		if(!file_exists($file) {
			throw new Exception('File not exist');
		}

		$this->fb = fopen($file, 'r');
		rewind($this->fb);

	}


	public function count() {
		// 统计总行数
		if(is_null($this->count)) {
			$this->count = 3;//intval(shell_exec("wc -l '{$this->filepath}'"));
		}
		return $this->count;
	}


	public function current() {

		
	}


	public function key() {


	}

	public function next() {

	}

	public function rewind() {
		rewind($this->fb);
	}


}