<?php


// function ->
//==============================================================

// 文字列を切り取る処理
function calc_str($string , $num){
	return substr($string , $num , 1);
}

// 小数点のもの含む数値と記号を配列に分ける処理
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
	$result = array_values($kakko_array);
	return $result;
}

// 正->負の値への変換処理
function neg_value($array){
	for ($i = 0; $i < count($array); $i++) {
		if (preg_match("/[\+\-\*\/]/" , $array[$i]) && $array[$i+1] == "-" && preg_match("/[0-9]/" , $array[$i+2]) ) {
			$array[$i+2] = strval($array[$i+1]).strval($array[$i+2]);
			unset($array[$i+1]);
			$i += 2;
		}
	}
	$result = array_values($array);
	return $result;
}

// 小数点がなくなるまで10倍して、計算した後割る処理
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
	foreach ($array as $value) {
		if (preg_match("/[0-9]/", $value)) {
			$ten_product[] = strval($value * pow(10, $k));
		}else{
			$ten_product[] = $value;
		}
	}
	$result = strval(func_calc($ten_product) / pow(10, $k));
	return $result;
}

// 配列内の計算処理
function func_calc($array){
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
	for($i = 0; $i < count($array); $i++) {
		switch ($array[$i]) {
			case "+":
			case "-":
			case "*":
			case "/":
			$result[count($result)-1] = $calc_symbol[$array[$i]]($result[count($result)-1] , $array[$i+1]);
			$i++;
				break;
			default:
				$result[] = $array[$i];
				break;
		}
	}
	return $result[0];
}


// <- function
//==============================================================







// ok
$test_a = find_point("2.05+2.5--1.5+4");
// ok
$test_b = neg_value($test_a);
// ok
$test_c = ten_power($test_b);
// ok
// $test_d = func_calc($test_c);

var_dump($test_c);


?>