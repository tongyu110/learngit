<?php
/**
 * User: xpc
 * Date: 2018/4/27
 * Description: 我们很多时候都需要导出数据，但是在不同的场景有着不同的需求如导出的格式
 */

abstract class Write {
    private $file = '';
    public function __construct($file)
    {
        $this->file = $file;
    }
    abstract public function write($data);
}

class CsvWrite extends  Write {

    /**
    * @param $data
    */
    public function write($data)
    {
        // 列的标题
        $field  = [];
        foreach($data as $_field=>$val) {
            $field[] = $_field;
        }
    }
}

class HtmlWrite extends Write {
    public function write($data) {
        // 列的标题
        $field  = [];
        foreach($data as $_field=>$val) {
            $field[] = $_field;
        }
    }
}

class DataExport {

    private $_write = null;
    public function __construct(Write $obj) {
        $this->_write = $obj;
    }

    public function write($data) {
        $this->_write->write($data);
    }

}

$data = [
    ['id'=>1,'title'=>'我们的故事','author'=>'abu'],
];

$obj = new DataExport(new CsvWrite());
$obj->write($data);





