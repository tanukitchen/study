<?php
$omikuji = array("大吉" , "中吉" , "小吉" , "凶" , "大凶");
$omikuji_count = array("大吉" => 0 , "中吉" => 0 , "小吉" => 0 , "凶" => 0 , "大凶" => 0);


// 出目の出現数をカウント
for ($i = 0; $i < 1000000; $i++) {
	$result = $omikuji[mt_rand(0 , 4)];
	$omikuji_count[$result] ++;
}

// 出目の出現数の結果を出力
print_r($omikuji_count);
?>

