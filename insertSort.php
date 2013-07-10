<?php
set_time_limit(0);
/**
 * 插入排序
 * @param $arr
 * @return array
 */
function insertSort($arr) {
    $num = count($arr);
    if($num <= 1) return $arr;
    for ($i = 1; $i < $num; $i++) {
        $x = $arr[$i];
        $j = $i - 1;
        while($j >= 0 && $x < $arr[$j]) {
            $arr[$j + 1] = $arr[$j];
            $j--;
        }
        $arr[$j + 1] = $x;
    }
    return $arr;
}

// 测试代码
$arr = range(1, 10000);
shuffle($arr);
echo '<hr>';
$start = microtime(true);
$res = insertSort($arr);
echo number_format((microtime(true) - $start) * 1000);
echo '<pre>';print_r($res);exit;
