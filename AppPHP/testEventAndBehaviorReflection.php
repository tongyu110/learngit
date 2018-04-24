<?php
/**
 * User: xpc
 * Date: 2018/4/24
 * Description: 实现 事件与行为的一实例
 */
class FileDb extends Component {
    private $fh = null;
    private $filepath = '';

    public function __construct()
    {
        $this->filepath = DB_FILE;
        $this->fh = fopen($this->filepath,'a+');
    }

    public function __destruct() {
        fclose($this->fh);
    }

    public function insert(Array $row) {
        fputcsv($this->fh,$row);

        // 添加一个触发事件
        $this->trigger('afterInsert',$row);
    }

    public function getFilePointer() {
        return $this->fh;
    }

}

// 添加事件功能
// 添加行为功能
abstract class Component {
    protected $_events = [];
    protected $_behavior = [];

    /**
     * 注册事件
     * @param $event_name
     * @param $handler
     */
    public function on($event_name,$handler) {
        if(!isest($this->_events[$event_name])) {
            $this->_events[$event_name] = [];
        }
        if(is_callable($handler)) {
            $this->_events[$event_name][] = $handler;
        }
    }

    /**
 * 触发事件
 * @param $event_name
 * @param $data
 */
    public function trigger($event_name,$data) {
        if($this->hasEventHandlers($event_name)) {
            foreach($this->_events[$event_name] as $_handler) {
                call_user_func($_handler,$data);
            }
        }
    }

    /**
     * 查看事件是否存在
     * @param $event_name
     * @return bool
     */
    public function hasEventHandlers($event_name) {
        if(isset($this->_events[$event_name])) {
            return true;
        }
        return false;
    }

    public function attachBehavior($behavior_name,$behavior) {
        if($behavior instanceof Behavior) {
            $this->_behavior[$behavior_name] = $behavior;
            $behavior->attach($this);
        }
    }


    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        foreach($this->_behavior as $_behavior) {
            if(method_exists($_behavior,$name)) {
                $_method = new ReflectionMethod($_behavior,$name);
                if($_method->isPublic()) {
                    return call_user_func_array([$_behavior,$name],$arguments);
                }
            }
        }
    }

}


abstract class Behavior {
    protected $owner = null;
    public function attach($to) {
        $this->owner = $to;
    }
}

class DbBehavior extends Behavior {
    public function getFirstRecord() {
        $fh = $this->owner->getFilePointer();
        $pos = ftell($fh);
        rewind($fh);
        $firstLine = fgets($fh);
        fseek($fh, $pos);
        return $firstLine;
    }
}


define('DB_FILE','./test.db');
$FileDb = new FileDb();

$data = ['id'=>1,'name'=>'abu','age'=>20];
$FileDb->insert($data);


$FileDb->attachBehavior('DbBehavior',new DbBehavior());
echo $FileDb->getFirstRecord();




