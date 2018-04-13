<?php

$file = './static/abu-2018-plan.docx';
$_file = './static/abu-2018-plan';
$_file1 = './static/abu-2018-plan1';
if(!file_exists($file)) {
    echo '文件不存在';exit;
}


$new_file = './static/abu-2018-plan1.docx';

$fp = fopen($_file, 'r');
$contens = fread($fp,  filesize($_file));
fclose($fp);

$fp = fopen($_file1, 'r');
$contens1 = fread($fp,  filesize($_file1));
fclose($fp);


$fp = fopen($new_file, 'w');
fwrite($fp,$contens.$contens1);
fclose($fp);



exit;




$file_size = filesize($file);
$_size = intval($file_size/2);
$_size1 = $file_size - $_size;

$fp = fopen($file, 'r');
$contens = fread($fp,$_size);
$contens1 = fread($fp,$_size1);
fclose($fp);

$fp = fopen($_file, 'w');
fwrite($fp, $contens);
fclose($fp);

$fp = fopen($_file1, 'w');
fwrite($fp, $contens1);
fclose($fp);




