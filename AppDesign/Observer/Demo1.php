<?php
/**
 * User: xpc
*  Date: 2018/4/27
*  Description: 用户注册与登录成功，当用户登录成功后，需要处理许多的非主业务，登录日志记录、Email 发送、购物车产品合并
*/
abstract class Observer {
    abstract function update(Observable $observable);
}

abstract class LoginObserver extends Observer {

    private $login = null;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    public function update(Observable $observable) {
        // 这种方式可以保证，被观察者是 Login
        if($observable == $this->login) {
            $this->doUpdate($observable);
        }
    }

    abstract function doUpdate(Login $login);
}


class SecurityMonitor extends LoginObserver {
    public function doUpdate(Login $login){
        $status = $login->getStatus();
        print " test Security \n";
    }
}

class GeneralLogger extends LoginObserver {
    public function doUpdate( Login $login ) {
        $status = $login->getStatus();
        // add login data to log
        print __CLASS__.":\tadd login data to log\n";
    }
}


abstract class Observable {
    // 添加观察者对象
    // 删除观察者对象
    // 通知观察者
    abstract function attach(Observer $observer);
    abstract function detach(Observer $observer);
    abstract function notice();
}

class Login extends Observable {

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    private $status = [];
    private $observers = [];

    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        //用回调函数过滤数组中的单元
        // 闭包的语法很简单，需要注意的关键字就只有use，use意思是连接闭包和外界变量。
        $this->observers = array_filter($observer,function($a) use ($observer){
            return (! ($a === $observer ));
        });
    }

    public function notice()
    {
        foreach($this->observers as $obj) {
                $obj->update($this);
        }
    }


    public function handleLogin($user,$pass,$ip) {
        // ...
        $isvalid=false;
        switch (rand(1,3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS,$user,$ip);
                $isvalid = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS,$user,$ip);
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN,$user,$ip);
                break;
        }
        $this->notice();
        return $isvalid;
    }

    private function setStatus($status,$user,$ip) {
        $this->status = [$status,$user,$ip];
    }

    public function getStatus() {
        return $this->status;
    }

}

$obj = new Login();
new SecurityMonitor($obj);
new GeneralLogger($obj);
$obj->handleLogin('abu','123456','127.0.0.1');




