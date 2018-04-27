<?php
/**
 * User: xpc
 * Date: 2018/4/27
 * Description: 动态地给一个对象添加一些额外的职责，就增加功能来说，装饰模式比派生子类更灵活。
 * https://blog.csdn.net/gdutxiaoxu/article/details/51885105
 * 咖啡店里咖啡中可以加不同的配料–摩卡、牛奶、糖、奶泡；不同的饮品加上不同的配料有不同的价钱
 */

interface Coffee {
    public function getPrice();
    public function getName();
}

class SimpleCoffee implements Coffee {

    public function getPrice()
    {
        return 100;
    }

    public function getName()
    {
        return 'SimpleCoffee';
    }
}

abstract class DecoratorCoffee implements Coffee {

    protected $coffee = null;
    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

}

class MilkDecorator extends DecoratorCoffee {
    public function getName()
    {
        return 'MilkDecorator';
    }
    public function getPrice()
    {
        return $this->coffee->getPrice() + 10;
    }
}

class SugarDecorator extends  DecoratorCoffee {
    public function getName() {
        return 'SugarDecorator';
    }
    public function getPrice() {
        return $this->coffee->getPrice() + 20;
    }
}

// 简单的
$simpleCoffee = new SimpleCoffee();
echo $simpleCoffee->getPrice() ."<br/>";

// 加奶的
$mklk = new MilkDecorator($simpleCoffee);
echo $mklk->getPrice() . "<br/>";

// 加糖的
$sugar = new SugarDecorator($simpleCoffee);
echo $sugar->getPrice() . "<br/>";


// 加奶 加糖 的
$mklkAndsugar = new SugarDecorator($mklk);
echo $mklkAndsugar->getPrice() . "<br/>";















