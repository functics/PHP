<?php 

/***************/

goto a;
echo "foo";

a:
echo "string";

/***************/

for ($i=0,$j=50; $i < 100; $i++) 
{ 
	while ($j--) 
	{
		if ($j == 17)
		{
			goto end;
		}
	}
}

echo "i = $i";
end:echo "j hit 17";

/***************/

goto loop;
for ($i=0, $j=50; $i < 100; $i++) { 
	while ($j--) {
		loop:
	}
}
echo "$i = $i";

#Fatal error: 'goto' into loop or switch statement is disallowed in D:\phpStudy\WWW\PHP\manual\Control_Structures\goto.php on line 29