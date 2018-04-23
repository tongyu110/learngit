<?php
/**
 * User: xpc
 * Date: 2018/4/23
 * Description:
 */

$dir = realpath('.');
$file = $dir.'/a.log';
$big_file = $dir.'/big_a.log';
//echo $file;exit;
$fd = fopen($file,'rb');
$content = fread($fd,filesize($file));
$data = explode("\n",$content);
fclose($fd);

$total = 5000000;
$row_count = 0;
$fd = fopen($big_file,'a+');
while (true) {

    if($row_count >= $total) { break; }
    foreach($data as $row) {
        if(empty($row)) { continue; }
        fwrite($fd,$row."\n");
        $row_count++;
        echo "count - {$row_count} \n";
    }

}







