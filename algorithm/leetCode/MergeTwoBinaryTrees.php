<?php 


// Given two binary trees and imagine that when you put one of them to cover the other, some nodes of the two trees are overlapped while the others are not.

// You need to merge them into a new binary tree. The merge rule is that if two nodes overlap, then sum node values up as the new value of the merged node. Otherwise, the NOT null node will be used as the node of new tree.
// Example 1:
// Input: 
// 	Tree 1                     Tree 2                  
//           1                         2                             
//          / \                       / \                            
//         3   2                     1   3                        
//        /                           \   \                      
//       5                             4   7                  
// Output: 
// Merged tree:
// 	     3
// 	    / \
// 	   4   5
// 	  / \   \ 
// 	 5   4   7

/********************************This is just for test*********************************/

// $list1 = $list2 = (object)array();     //$list1 and $list2 point to the same address

/********************************This is just for test*********************************/
/**
 *Oriented process
 */
$list1 = new stdClass();
$list2 = new stdClass();

$list1->header = 1;
$list1->left = 3;
$list1->right = 2;
$list1->left->left = 5;

print_r($list1);

function mergeTwoBinaryTree ($list1, $list2)
{
	
}