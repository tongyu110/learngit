<?php

ob_flush();

$file = realpath(__DIR__)."/process.lock";
$fd = fopen($file,"w");

if($fd == false) {
   echo "Can not create lock file {$file}\n";
}

if(!flock($fd,LOCK_EX+LOCK_NB)) {
  die(date("Y-m-d H:i:s") . " Process already exists.\n"); 
}

$i = 0;
while(true) {

echo $i . "\n";
$i++;
}


