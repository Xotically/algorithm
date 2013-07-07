<?php
set_time_limit(0);
function HeapAdjust(&$arr, $length, $index) {
    $left = 2 * $index + 1;
    $right = 2 * $index + 2;
    $max = $index;
    while ($left < $length || $right < $length) {
        if ($left < $length && $arr[$max] < $arr[$left]) {
            $max = $left;
        }

        if ($right < $length && $arr[$max] < $arr[$right]) {
            $max = $right;
        }

        if ($max != $index) {
            $tmp = $arr[$index];
            $arr[$index] = $arr[$max];
            $arr[$max] = $tmp;

            $index = $max;
            $left = 2 * $index + 1;
            $right = 2 * $index + 2;
        } else {
            break;
        }
    }
}

function HeapSort($arr) {
    $length = count($arr);
    $begin = $length/2 - 1;  //最后一个非叶子节点
    for ($x = $begin; $x >= 0; $x--) {
        HeapAdjust($arr, $length, $x);
    }

    $i = $length;
    while($i > 1) {
        $tmp = $arr[0];
        $arr[0] = $arr[$i - 1];
        $arr[$i - 1] = $tmp;
        $i--;
        HeapAdjust($arr, $i, 0);
    }

    return $arr;
}
$arr = array(4,1,3,5);
$test = HeapSort($arr);
echo '<pre>';print_r($test);exit;
