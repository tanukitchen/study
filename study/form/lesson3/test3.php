<?php
// $calc_get = "(1+2)(3+4)+2(1+1)3";
$calc_get = "(((1+2)+3)+4)";

$calc_len = strlen($calc_get);

function calc_str($string , $num){
	return substr($string , $num , 1);
}

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

function get_last_key($array){
	return count($array)-1;
}

function array_calc($str){
	global $calc_symbol;
	$kakko_len = strlen($str);
	$num = 0;
	for ($i = 0; $i < $kakko_len; $i++) {
		$kakko_str = substr($str , $i , 1);
		if (preg_match("/^[0-9]+$/", $kakko_str)) {
			$kakko_array[$num] .= $kakko_str;
		}else{
			$num++;
			$kakko_array[$num] .= $kakko_str;
			$num++;
		}
	}
	for($i = 0; $i < count($kakko_array); $i++) {
		switch ($kakko_array[$i]) {
			case "+":
			case "-":
			$kakko_result[get_last_key($kakko_result)] = $calc_symbol[$kakko_array[$i]]($kakko_result[get_last_key($kakko_result)], $kakko_array[$i+1]);
			$i++;
				break;
			default:
				$kakko_result[] = $kakko_array[$i];
				break;
		}
	}
	return $kakko_result[0];
}

	// )( or )n or n( だったら間に"*"を入れる処理
for ($i=0; $i < $calc_len; $i++) {
	$calc_add_multi .= calc_str($calc_get , $i);
	// )( or )n or n(
	switch (true) {
		case calc_str($calc_get , $i) == ")" && calc_str($calc_get , $i+1 ) == "(":
		case calc_str($calc_get , $i) == ")" && preg_match("/^[0-9]+$/", calc_str($calc_get , $i+1)):
		case preg_match("/^[0-9]+$/", calc_str($calc_get , $i)) && calc_str($calc_get , $i+1) == "(":
			$calc_add_multi .= "*";
			break;
	}
}

// OK
/*if (strpos($calc_add_multi , ")") != False) {
	$get = substr($calc_add_multi , 0 , strpos($calc_add_multi , ")"));
	$result[0] = substr($get , 0 , strrpos($get , "("));
	$result[1] = substr($get , strrpos($get , "(")+1);
	$result[2] = substr($calc_add_multi , strpos($calc_add_multi , ")")+1);
	$calc_add_multi = $result[0].array_calc($result[1]).$result[2];
}*/

// OK
function calc_kakko($string){
	if (preg_match("/[(]/" , $string)) {
		$get = substr($string , 0 , strpos($string , ")"));
		$result[0] = substr($get , 0 , strrpos($get , "("));
		$result[1] = substr($get , strrpos($get , "(")+1);
		$result[2] = substr($string , strpos($string , ")")+1);
		$string = $result[0].array_calc($result[1]).$result[2];
		return calc_kakko($string);
		// calc_kakko($result[0].array_calc($result[1]).$result[2]);
	}
	return $string;
}

// OK
/*while (preg_match("/[(]/" , $calc_add_multi)) {
	$get = substr($calc_add_multi , 0 , strpos($calc_add_multi , ")"));
	$result[0] = substr($get , 0 , strrpos($get , "("));
	$result[1] = substr($get , strrpos($get , "(")+1);
	$result[2] = substr($calc_add_multi , strpos($calc_add_multi , ")")+1);
	$calc_add_multi = $result[0].array_calc($result[1]).$result[2];
}*/



echo calc_kakko($calc_add_multi);
// echo $calc_add_multi;


 ?>