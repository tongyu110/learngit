<?php
/**
 * User: xpc
 * Date: 2018/4/24
 * Description:
 */

class Base  {
    public function getInfo() {

    }
}

class Test extends Base {
    public function getName() {
        return 'abu';
    }
    private function getAge() {
        return 20;
    }
}

$test_obj = new Test();
$R_class = new ReflectionObject($test_obj);
echo $R_class->getName()."\n";          // 输了同类名
echo $R_class->getFileName()."\n";      // 输出类文件地址
exit;


$R_method = new ReflectionMethod('Test','getAge');
// 查看方法是否公开
if($R_method->isPublic()) {
    echo '1';
}else {
    echo '0';
}



