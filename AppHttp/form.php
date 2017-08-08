<?php

// 使用这函数模似登录
// file_get_contents();
$postData = array(
    'title' => '我是 file_get_content 构造的数据',
    'content' => '我是内容',
    'publish' => '发布'
);
$postData = http_build_query($postData);
$opt = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Host:localhost\r\n".
	    "Content-type:application/x-www-form-urlencoded\r\n' .
        "Content-length:" . strlen($postData) . "\r\n",
        'content' => $postData
    )
);
$content = stream_context_create($opt);
file_get_contents('http://www.php.me', false, $content);




?>
