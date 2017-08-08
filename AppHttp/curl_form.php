<?php

$postData = array(
    'title' => '我是 file_get_content 构造的数据',
    'content' => '我是内容',
    'publish' => '发布'
);

// 初始化一个 curl 会话
$ch = curl_init();
// 设置相应的会话选项
// 设置提交的网址
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$postData);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$re = curl_exec($ch);
curl_close($ch);
echo $re;

?>
