<?php 

// Given an array of integers, return indices of the two numbers such that they add up to a specific target.

// You may assume that each input would have exactly one solution, and you may not use the same element twice.

// Example:
// Given nums = [2, 7, 11, 15], target = 9,

// Because nums[0] + nums[1] = 2 + 7 = 9,
// return [0, 1].

function twoSum($nums, $target)   // n^2
{
	for ($i = 0; $i < count($nums); $i++) { 
		for ($j = count($nums) - 1; $j > 0; $j--) { 
			if ($nums[$i] + $nums[$j] == $target) {
				return print_r([$i, $j]);
			}
		}
	}
}
twoSum([1,3,8,14,16,22,12,17], 23);