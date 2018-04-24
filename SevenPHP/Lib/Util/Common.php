<?php
/**
 * User: xpc
 * Date: 2018/4/24
 * Description: 工具公共类
 */

namespace SevenPHP\Lib\Util;


class Common
{


    /**
     * 对二维数，排序
    * @param $data
    * @param string $key
    * @param string $sort      asc|desc
    * @param int $type
    * @return []
    */
    public static function arrayMultiSort($data, $key = 'id', $sort = 'asc', $type = SORT_REGULAR) {
        $key_data = array();
        foreach ($data as $k => $row) {
            $key_data[$k] = $row[$key];
        }
        // 处理排序方向
        $sort_direction = SORT_ASC;
        if (strtolower($sort) == 'desc') {
            $sort_direction = SORT_DESC;
        }
        // 按照名称重复率排列数组
        array_multisort($key_data, $sort_direction, $type, $data);
        return $data;
    }

}