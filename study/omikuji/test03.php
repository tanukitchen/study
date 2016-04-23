<?php
$omikuji = array("大吉" , "中吉" , "小吉" , "凶" , "大凶");
$omikuji_count = array("大吉" => 0 , "中吉" => 0 , "小吉" => 0 , "凶" => 0 , "大凶" => 0);

for ($i=0; $i < 10000; $i++) {
	$num = mt_rand();
	$num %= 5;
	$omikuji_count[$omikuji[$num]] ++;
}



print_r($omikuji_count);
