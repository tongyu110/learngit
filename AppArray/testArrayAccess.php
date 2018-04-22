<?php
/**
 * User: xpc
 * Date: 2018/4/22
 * Description:
 */

class Test implements ArrayAccess {

    private $container = [];

    public function offsetSet($offset, $value) {
        if(is_null($offset)) {
            $this->container[] = $value;
        }else {
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($var) {
        return isset($this->container[$var])?true:false;
    }
    public function offsetUnset($var) {
        if($this->container($var)) {
            unset($this->container[$var]);
        }
    }
    public function offsetGet($var) {
        return $this->offsetExists($var)?$this->container[$var]:'';
    }

}

$obj = new Test();
$obj = ['name'=>1];

if(isset($obj['name'])) {

}

echo $obj['name'];



