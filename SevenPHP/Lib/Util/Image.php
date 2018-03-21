<?php

namespace SevenPHP\Lib\Util;

/**
 * Description of Image
 * @author xpc
 */
class Image {

    /**
     * 将图片转在 Base64 编码方式 
     * @param String $image_file    图片地址
     * @return string
     */
    public static function base64EncodeImage($image_file) {
        $base64_image = '';
        $image_info = getimagesize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
        return $base64_image;
    }
    
}
