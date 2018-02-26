<?php

/**
 * LIST
 */
class Olist 
{
	public $data;
	public $next;
	
	public function __construct($param1 = array(), $param2 = array())
	{

	}

	public function addNode()
	{ 
		$oList = new Olist();
		$this->next = $oList;
	}
}

$oList1 = new Olist();
$oList1->addNode();
$oList1->addNode();
print_r($oList1);

