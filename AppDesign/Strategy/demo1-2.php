<?php
/**
 * User: xpc
 * Date: 2018/4/27
 * Description:     排序功能，对二维数组，可按不同的字段进行排序 , ID 、Date
 */
class ObjectCollection  {

    private $_elements = [];
    private $_comparator = null;
    public function __construct(Array $elements) {
        $this->_elements = $elements;
    }

    public function sort() {
        if(is_null($this->_comparator)) { return false; }
        $callback = array($this->_comparator,'compare');
        uasort($this->_elements,$callback);
        return $this->_elements;
    }

    public function setComparator(ComparatorInterface $obj) {
        $this->_comparator = $obj;
    }

}

//interface ComparatorInterface {
//    public function compare($a,$b);
//}

abstract class ComparatorInterface {

    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';
    protected $_default_sort = 'asc';
    public function __construct($default_sort=self::SORT_ASC)
    {
        $_default_sort = strtolower($default_sort)==='asc'?'asc':'desc';
        $this->_default_sort = $_default_sort;
    }

}

class IdComparator extends ComparatorInterface {
    public function compare($a,$b) {
        if($a['id'] == $b['id']) {
            return 0;
        }else {
            if($this->_default_sort == self::SORT_ASC) {
                return $a['id']>$b['id']?1:-1;
            }else {
                return $a['id']>$b['id']?-1:1;
            }
        }
    }
}

class DateComparator extends ComparatorInterface {
    public function compare($a,$b) {
        $a_date = new DateTime($a['date']);
        $b_date = new DateTime($b['date']);
        if($a_date == $b_date) {
            return 0;
        }else {
            if($this->_default_sort == self::SORT_ASC) {
                return $a_date>$b_date?1:-1;
            }else {
                return $a_date>$b_date?-1:1;
            }
        }
    }
}

$data = [
    ['id'=>1,'title'=>'我们的歌','date'=>'2018-4-27'],
    ['id'=>10,'title'=>'你过来呀。。。','date'=>'2018-1-1'],
    ['id'=>3,'title'=>'江湖第一风骚男','date'=>'2015-2-05']
];
$obj = new ObjectCollection($data);
$obj->setComparator(new DateComparator());
$sdata = $obj->sort();
var_dump($sdata);




