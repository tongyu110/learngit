<?php
/**
 * User: xpc
 * Date: 2018/4/23
 * Description:
 */

class Test implements Iterator {

    private $data = [];
    private $position = 0;

    public function __construct($data) {
        $this->data = $data;
    }

        //返回当前产生的值
    public function current( ) {
        return $this->data[$this->position];
    }
        //返回当前产生的键
    public function key( ) {
        return $this->position;
    }
        //生成器继续执行
    public function next(  ){
        ++$this->position;
    }
        //重置迭代器,如果迭代已经开始了，这里会抛出一个异常。
    public function rewind( ) {
        $this->position = 0;
    }
        //检查迭代器是否被关闭,已被关闭返回 FALSE，否则返回 TRUE
    public function valid(  ) {
        return isset($this->data[$this->position])?true:false;
    }

}



$data = range(1,100000);
$obj = new Test($data);
foreach($obj as $k=>$v) {
    echo $v;
}

echo memory_get_usage(true);





