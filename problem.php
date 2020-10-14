<?php
$i;
for ($i = 1; $i <= 100; $i++)
{
    // Divisible by 3 and 5 
    if (($i % (3*5)) == 0) 
        echo "FizzBuzz" . "  "; 
     
    // Divisible by 3? print 
    // 'Fizz' in place of the number
    else if (($i % 3) == 0) 
        echo "Fizz" . "  ";             
     
    // Divisible by 5, print 
    // 'Buzz' in place of the number
    else if (($i % 5) == 0)                 
        echo "Buzz" . "  ";             
 
    else // print the number         
        echo $i,"  " ;             
}
