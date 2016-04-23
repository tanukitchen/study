<?php
// 試作1
//==========================================================

$omikuji = array("大吉" , "中吉" , "小吉" , "凶" , "大凶");

$num = mt_rand( 0 , 6 );

echo $omikuji[$num];

// 20回回してみた
/*for ($i=0; $i < 20; $i++) {
	$num = mt_rand( 0 , 6 );
	echo $omikuji[$num]."<br />\n";
}*/

// 試作2
//==========================================================

// $num2 = range(0 , 4);
// shuffle($num2);

// echo $omikuji[$num2[$num]];

// 20回回してみた
// for ($i=0; $i < 20; $i++) {
// 	$num2 = range(0 , 4);
// 	shuffle($num2);
// 	echo $omikuji[current($num2)]."<br />\n";
// }



 ?>