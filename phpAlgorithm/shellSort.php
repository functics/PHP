<?php
/**
 * 希尔排序（Shell Sort）1959年Shell发明，第一个突破O(n2)的排序算法，是简单插入排序的改进版。
 * 它与插入排序的不同之处在于，它会优先比较距离较远的元素。希尔排序又叫缩小增量排序。
 *
 *
 * 算法描述：
 *
 * 先将整个待排序的记录序列分割成为若干子序列分别进行直接插入排序，具体算法描述：

 * 选择一个增量序列t1，t2，…，tk，其中ti>tj，tk=1；
 * 按增量序列个数k，对序列进行k 趟排序；
 * 每趟排序，根据对应的增量ti，将待排序列分割成若干长度为m 的子序列，分别对各子表进行直接插入排序。仅增量因子为1 时，整个序列作为一个表来处理，表长度即为整个序列的长度。
 *
 * 
 * 算法时间复杂度 O(n1.3)
 * 
 */

$arr = [3, 44, 38, 5, 47, 15, 36, 26, 27, 2, 46, 4, 19, 50, 48];

function ShellSort($arr) : array
{
    $length = count($arr);
    $gap = 1;

    // 动态定义间隔序列
    while ($gap < ($length / 3)) {
        $gap = $gap * 3 + 1;
    }

    for ($gap; $gap > 0; $gap = floor($gap / 3)) {
        for ($i = $gap; $i < $length; $i ++) {
            $temp = $arr[$i];
            for ($j = $i - $gap; $j >= 0 && $arr[$j] > $temp; $j -= $gap) {
                $arr[$j + $gap] = $arr[$j];
            }
            $arr[$j + $gap] = $temp;
        }
    }

    return $arr;
}

print_r(ShellSort($arr));