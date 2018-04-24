<?php
/**
 * User: xpc
 * Date: 2018/4/23
 * Description:
 */

class myIterator implements Iterator {
    private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );

    public function __construct() {
        $this->position = 0;
    }

    function rewind() {
        var_dump(__METHOD__);
        $this->position = 0;
    }

    function current() {
        var_dump(__METHOD__);
        return $this->array[$this->position];
    }

    function key() {
        var_dump(__METHOD__);
        return $this->position;
    }

    function next() {
        var_dump(__METHOD__);
        ++$this->position;
    }

    function valid() {
        var_dump(__METHOD__);
        return isset($this->array[$this->position]);
    }
}



class sample implements Iterator
{
    private $_items = array(1,2,3,4,5,6,7);
    public function __construct() {
        ;//void
    }

    public function rewind() { reset($this->_items); }
    public function current() { return current($this->_items); }
    public function key() { return key($this->_items); }
    public function next() { return next($this->_items); }
    public function valid() { return ( $this->current() !== false ); }
}




$it = new myIterator();

foreach($it as $key => $value) {
    print_r($value);
    echo "\n";
}







