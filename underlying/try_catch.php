<?php
$name = "name";

//check if the name contains only letters, and does not contain the word name  

try 
{
	try 
	{
		if (preg_match('/[^a-z]/i', $name)) 
		{
			throw new Exception("$name contains character other than a-z A-Z");
		}
		if (strpos(strtolower($name), 'name') !== FALSE)
		{
			throw new Exception("$name contains the word name");
		}
		echo "The name is valid";
	} 
	catch (Exception $e) 
	{
		throw new Exception("Insert name again", 0, $e);
	}
} 
catch (Exception $e) 
{
	if ($e->getPrevious()) 
	{
		echo "The Previous Exception is: ".$e->getPrevious()->getMessage()."<br />";
	}
	echo "The Exception is: ".$e->getMessage()."<br />";
}