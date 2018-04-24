<?php

/**
  *  blog:http://www.zhaokeli.com
 * 处理成圆图片,如果图片不是正方形就取最小边的圆半径,从左边开始剪切成圆形
 * @param  string $imgpath [description]
 * @return [type]          [description]
 */
function yuan_img($imgpath = './tx.jpg') {
	$ext     = pathinfo($imgpath);
	$src_img = null;
	switch ($ext['extension']) {
	case 'jpg':
		$src_img = imagecreatefromjpeg($imgpath);
		break;
	case 'png':
		$src_img = imagecreatefrompng($imgpath);
		break;
	}
	$wh  = getimagesize($imgpath);
	$w   = $wh[0];
	$h   = $wh[1];
	$w   = min($w, $h);
	$h   = $w;
	$img = imagecreatetruecolor($w, $h);
	//这一句一定要有
	imagesavealpha($img, true);
	//拾取一个完全透明的颜色,最后一个参数127为全透明
	$bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
	imagefill($img, 0, 0, $bg);
	$r   = $w / 2; //圆半径
	$y_x = $r; //圆心X坐标
	$y_y = $r; //圆心Y坐标
	for ($x = 0; $x < $w; $x++) {
		for ($y = 0; $y < $h; $y++) {
			$rgbColor = imagecolorat($src_img, $x, $y);
			if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
				imagesetpixel($img, $x, $y, $rgbColor);
			}
		}
	}
	return $img;
}