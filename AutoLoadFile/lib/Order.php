<?php

namespace AutoLoadFile\lib;
class Order {

    public function __construct() {
        echo 'Class NameSpace is "', __NAMESPACE__, '"';
    }
    
    public function show_list() {
        return 'test';
        for ($i = 0; $i < 5; $i++) {
            echo "<ul><li>this is order$i<br />";
            //内部直接访问
            echo detail();
            echo "</li></ul>";
        }
    }

}

/*
class TestSatic {

    public static function display1() {
        echo 'test static';
    }

}
*/

?>