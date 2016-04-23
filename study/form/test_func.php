<?php

// 計算処理
function calc($symbol , $int1 , $int2){
	$calc_symbol = array(
		"+" => function($lhs , $rhs){
			return $lhs + $rhs;},
		"-" => function($lhs , $rhs){
			return $lhs - $rhs;},
		"*" => function($lhs , $rhs){
			return $lhs * $rhs;},
		"/" => function($lhs , $rhs){
			return $lhs / $rhs;},
			);
	$result = $calc_symbol[$symbol]( $int1 , $int2 );
	return $result;
}

// 配列の最後の要素のキーを取得する処理
function get_last_key($array){
	return count($array)-1;
}

// 小数点の数値と記号を分ける処理
function find_point($str){
	$kakko_len = strlen($str);
	$num = 0;
	for ($i = 0; $i < $kakko_len; $i++) {
		$kakko_str = substr($str , $i , 1);
		if (preg_match("/^[0-9|\.]+$/", $kakko_str)) {
			$kakko_array[$num] .= $kakko_str;
		}else{
			$num++;
			$kakko_array[$num] .= $kakko_str;
			$num++;
		}
	}
	$kakko_array = array_values($kakko_array);
	return $kakko_array;
}

// 正->負の値への変換処理
function neg_value($array){
	for ($i = 0; $i < count($array); $i++) {
		if (preg_match("/[\+\-\*\/]/" , $array[$i]) && $array[$i+1] == "-" && preg_match("/[0-9]/" , $array[$i+2]) ) {
			$array[$i+2] = strval($array[$i+1].$array[$i+2]);
			unset($array[$i+1]);
			$i += 2;
		}
	}
	$result = array_values($array);
	var_dump($result);
	return $result;
}

// 小数点がなくなるまで10倍して計算して同じ数割る処理
function ten_power($array){
	$j = 0;
	$k = 0;
	foreach ($array as $value) {
		if (preg_match("/[\.]/", $value)) {
			$j = strlen(substr($value , strpos($value, "."))) - 1;
		}
		if ($j > $k) {
			$k = $j;
		}
	}
	foreach ($array as &$value) {
		if (preg_match("/[0-9]/", $value)) {
		$value = $value * pow(10, $k);
		$value = strval($value);
		}
	}
	$result = $kakko_result[0] / pow(10, $k);
	return $result;
}

$test = find_point("2.05+2.5--1.5+3");
$test_sec = ten_power($test);
var_dump($test_sec);
// echo "\n"."<br>".$k;


// なぜかneg_valueが動いていない



 ?>