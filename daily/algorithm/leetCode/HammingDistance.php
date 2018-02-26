<?php 
// The Hamming distance between two integers is the number of positions at which the corresponding bits are different.
// Given two integers x and y, calculate the Hamming distance.
// Note:
// 0 ≤ x, y < 231.



// Input: x = 1, y = 4

// Output: 2

// Explanation:
// 1   (0 0 0 1)
// 4   (0 1 0 0)
//        ?   ?


// The above arrows point to positions where the corresponding bits are different.
/**
 *获取汉明距离
 */
function hammingDistance($x, $y)
{
	$container = $x ^ $y;
	$container = toBinary($container);
	$distance = 0;
	for ($i=0; $i < strlen($container); $i++) { 
		if ($container[$i] == 1) {
			$distance += 1;
		}
	}
	return $distance;
}


/**
 *获取整形的二进制
 */
function toBinary($int)
{
	$remainder = 1;
	$remainder_str = '';
	while ($int != 1) {
		$remainder = $int % 2;
		$int = ($int - $remainder) / 2;
		$remainder_str = (string)$remainder.$remainder_str;
	}
	$remainder_str = $int.$remainder_str;
	return $remainder_str;
}


echo hammingDistance(4, 1);