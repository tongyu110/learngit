<?php
/**
 * Created by PhpStorm.
 * User: Abu
 * Date: 2019/4/18
 * Time: 13:39
 */



$extStartTime = time();

$limit = 10;
for($i=1;$i<=10;$i++) {
    _exec($i,$limit);
}

$extEndTime = time();

echo "execution time: ". ($extEndTime - $extStartTime) ."\n";
exit;


function _exec($step,$limit) {


    $mysqli = new mysqli('192.168.1.162','root','','Test_1');
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $mysqli->query('set names utf8');

    $sql_values = '';
    $insert_datas = getRandInsertData($limit);
    foreach($insert_datas as $data) {
        if(empty($sql_values)) {
            $sql_values = "('{$data['name']}','{$data['email']}',{$data['sex']},{$data['reg_time']},{$data['status']},{$data['source']})";
        }else {
            $sql_values .= ",('{$data['name']}','{$data['email']}',{$data['sex']},{$data['reg_time']},{$data['status']},{$data['source']})";
        }
    }


    $extStartTime = time();

    $_f = 'name,email,sex,reg_time,status,source';
    $_s = "INSERT INTO user ({$_f}) VALUES {$sql_values};";
    $_re = $mysqli->query($_s);

    $extEndTime = time();

    $mysqli->close();

    $log = "{$step}	".($extEndTime-$extStartTime);
    file_put_contents('re_log.txt',$log,FILE_APPEND);

}


function getRandInsertData($num) {

    $email_suffix = ['@163.com','@qq.com','@gmail.com'];
    $now_time = time();
    $datas = [];
    for($i=$num;$i>0;$i--) {
        $_data = [];
        $_data['source'] = rand(1,4);
        $_data['name'] = ucfirst(strtolower(getRandChar(rand(3,5)))).' '.ucfirst(strtolower(getRandChar(rand(3,10))));

        $email = '';
        if(1 == $_data['source']) {
            shuffle($email_suffix);
            $email = str_replace(' ','',$_data['name']).$email_suffix[0];
        }

        $_data['email'] = $email;
        $_data['sex'] = rand(1,2);

        $_rand_day = rand(0,100);
        $_data['reg_time'] = $now_time - ($_rand_day * 24 * 60 * 60);



        $_data['status'] = rand(0,100)==0?0:1;
        $datas[] = $_data;
    }
    return $datas;
}

function getRandChar($length) {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;
        for ($i = 0;$i < $length;$i++) {
            $str .= $strPol[rand(0, $max)];
        }
        return $str;
    }



?>
