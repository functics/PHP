<?php

/**
 * 归并排序是建立在归并操作上的一种有效的排序算法。该算法是采用分治法（Divide and Conquer）的一个非常典型的应用。
 * 将已有序的子序列合并，得到完全有序的序列；即先使每个子序列有序，再使子序列段间有序。若将两个有序表合并成一个有序表，称为2-路归并。 
 *
 *
 * 算法描述：
 *
 * 一般来说，插入排序都采用in-place在数组上实现。具体算法描述如下：
 *
 * 把长度为n的输入序列分成两个长度为n/2的子序列；
 * 对这两个子序列分别采用归并排序；
 * 将两个排序好的子序列合并成一个最终的排序序列。
 *
 * 
 * 算法时间复杂度 O(nlog2n)
 * 
 */

$arr = [3, 44, 38, 5, 47, 15, 36, 26, 27, 2, 46, 4, 19, 50, 48];

function mergeSort($arr) : array
{
    $length = count($arr);
    if ($length < 2) {
        return $arr;
    }

    $middle = floor($length / 2);
    $left   = array_slice($arr, 0, $middle);
    $right  = array_slice($arr, $middle);

    return merge(mergeSort($left), mergeSort($right));
}

function merge($left, $right)
{
    $result = [];

    while (count($left) > 0 && count($right) > 0) {
        if ($left[0] < $right[0]) {
            array_push($result, array_shift($left));
        } else {
            array_push($result, array_shift($right));
        }
    }

    while (count($left)) {
        array_push($result, array_shift($left));
    }

    while (count($right)) {
        array_push($result, array_shift($right));
    }

    return $result;
}

print_r(mergeSort($arr));
