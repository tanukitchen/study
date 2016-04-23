<?php

$omikuji = array("大吉" , "中吉" , "小吉" , "凶" , "大凶");
$omikuji_count = array("大吉" => 0 , "中吉" => 0 , "小吉" => 0 , "凶" => 0 , "大凶" => 0);


// $omikuji_num = range(0 , 4);


// 出目の出現数をカウント
for ($i = 0; $i < 10000; $i++) {
	$num = mt_rand( 1 , 100 );
	switch (true) {
		case $num >= 1 && $num <= 20:
			$omikuji_count["大吉"]  ++;
			break;
		case $num >= 21 && $num <= 40:
			$omikuji_count["中吉"]  ++;
			break;
		case $num >= 41 && $num <= 60:
			$omikuji_count["小吉"]  ++;
			break;
		case $num >= 61 && $num <= 80:
			$omikuji_count["凶"]  ++;
			break;
		case $num >= 81 && $num <= 100:
			$omikuji_count["大凶"]  ++;
			break;
	}
}

// 出目の出現数の結果を出力
print_r($omikuji_count);

 ?>