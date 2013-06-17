<?php
set_time_limit(0);
/**
 * 归并排序
 */
function mergeSort($arr) {
    // 计算数组里的个数, 如果只有一个成员, 直接返回
    $count = count($arr);
    if($count <= 1) {
        return $arr;
    }

    //如果成员很多, 那么对左边 归并, 对右边归并
    $mid = floor($count / 2);
    $left = mergeSort(array_slice($arr, 0, $mid));
    $right = mergeSort(array_slice($arr, $mid));

    // 左半数组的大小, 右半数组的大小
    $leftLen = count($left);
    $rightLen = count($right);

    //返回值保存的变量
    $ret = array();
    $li = $ri = 0;

    while(1) {
        // 如果左边全合并了, 则退出循环
        if($li >= $leftLen) {
            $flag = 'left';
            break;
        }
        // 如果右边全合并了, 则退出循环
        if($ri >= $rightLen) {
            $flag = 'right';
            break;
        }

        //如果左边的数小, 则左边加入返回数组
        if($left[$li] <= $right[$ri]) {
            $ret[] = $left[$li];
            $li ++;
        } else {
            $ret[] = $right[$ri];
            $ri ++;
        }
    }

    if($flag == 'left') {
        //如果首先合并完的是左边, 则把右数组剩余的都加到返回数组
        $ret = array_merge($ret, array_slice($right, $ri));
    } elseif($flag == 'right') {
        $ret = array_merge($ret, array_slice($left, $li));
    }

    return $ret;
}

function kuaisu($arr){
    $len = count($arr);
    if($len <= 1){
        return $arr;
    }
    $key = $arr[0];
    $left_arr = array();
    $right_arr = array();
    for($i=1; $i<$len;$i++){
        if($arr[$i] <= $key){
            $left_arr[] = $arr[$i];
        }else{
            $right_arr[] = $arr[$i];
        }
    }
    $left_arr = kuaisu($left_arr);
    $right_arr = kuaisu($right_arr);
    return array_merge($left_arr, array($key), $right_arr);
}


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
//var_dump($arr);
echo '<hr>';
$start = microtime(true);
$res = insertSort($arr);
echo number_format((microtime(true) - $start) * 1000);
//echo '<pre>';print_r($res);exit;
echo '<br>';


$start = microtime(true);
$res = mergeSort($arr);
echo number_format((microtime(true) - $start) * 1000);
echo '<br>';


$start = microtime(true);
$res = kuaisu($arr);
echo number_format((microtime(true) - $start) * 1000);
echo '<br>';

//$start = microtime(true);
//$res = bubble_sort($arr);
//echo number_format((microtime(true) - $start) * 1000);
//echo '<pre>';print_r($res);exit;
//echo '<br>';
