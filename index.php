<?php

include "../../vendor/autoload.php";

use Expression\Calculate;
use Expression\StackObj;

$cal = '9+(3-1)*3+10/2';
$exp = '9 3 1 - 3 * + 10 2 / +';
$exp_arr = explode(' ', $exp);

$stack = new StackObj();


$cal = new Calculate();
$result = $cal->excute($exp);

dump('结果：' . $result);


$exp = '9 + ( 3 - 1 ) * 3 + 10 / 2';
//$exp = '3 + ( 2 - 5 ) * 6 / 3';  //3 2 5 - 6 * 3 / +
//$exp = '( 3 + 4 ) * 5 - 6';  //3 4 + 5 × 6 -

$b = $cal->exchangeCal1($exp);
dump(implode(' ', $b));


//3 2 5 - 6 * 3 / +