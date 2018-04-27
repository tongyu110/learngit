<?php
/**
 * User: xpc
 * Date: 2018/4/27
 * Description:  我们公司要出游玩，到东江湖 , 这下大家在讨论如何去东江湖呢
 */

abstract class ITravelTransport {
    abstract public function travel();
}

class PlaneTravelTransport extends ITravelTransport {

    public function travel() {
        echo '我们要做飞机去  ---  游玩';
    }
    
}

class TrainTravelTransport extends ITravelTransport {
    public function travel() {
        echo "我们要做火车去  ---  游玩";
    }
}

class Travel {
    private $_transport = null;
    public function __construct(ITravelTransport $obj) {
        $this->_transport = $obj;
    }

    public function transport() {
        $this->_transport->travel();
    }
}

$travel_obj = new Travel(new PlaneTravelTransport());
$travel_obj->transport();

