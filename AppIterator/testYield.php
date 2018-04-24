<?php
/**
 * User: xpc
 * Date: 2018/4/23
 * Description:
 */

function squares($start,$stop) {

    if($start < $stop) {
        for($i=$start;$i<=$stop;$i++) {
            yield $i => $i * $i;
        }
    }else {
        for($i=$start;$i>=$stop;$i--) {
            yield $i => $i * $i;
        }
    }

}

function it()
{
    for($count=1000000; $count--;)
    {
        yield $count/2;
    }
}

if(false) {

    $start_time=microtime(true);
    $array = array();
    $result = '';
    for($count=1000000; $count--;)
    {
        $array[]=$count/2;
    }
    foreach($array as $val)
    {
        $val += 145.56;
        $result .= $val;
    }
    $end_time=microtime(true);

    echo "time: ", bcsub($end_time, $start_time, 4), "\n";
    echo "memory (byte): ", memory_get_peak_usage(true), "\n";

}else {

    $start_time=microtime(true);
    $result = '';
    foreach(it() as $val)
    {
        $val += 145.56;
        $result .= $val;
    }
    $end_time=microtime(true);

    echo "time: ", bcsub($end_time, $start_time, 4), "\n";
    echo "memory (byte): ", memory_get_peak_usage(true), "\n";
}







