<?php

// �َ��I��ǟo�ޥ�`�פˤʤ롣�v���ˆ��}���ꡣ �ο���

/*
�ο�
function func($str) {
	if (������Ҋ�Ĥ��ä�����) {
		$result = $str;
		# �I���ޤ���
		return func($result[0]. calc($result[1]) . $result[2]);
	} else {
		return $str
	}
}

*/

$calc_get = "(1+2)(3+4)+2(1+1)3";
$calc_len = strlen($calc_get);

function calc_str($string , $num){
	return substr($string , $num , 1);
}

	// )( or )n or n( ���ä����g��"*"������I��
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
	/*if (calc_str($calc_get , $i) == ")" && calc_str($calc_get , $i+1) == "(") {
		# code...
	}elseif (calc_str($calc_get , $i) == ")" && preg_match("/^[0-9]+$/", calc_str($calc_get , $i+1))) {
		# code...
	}elseif (preg_match("/^[0-9]+$/", calc_str($calc_get , $i)) && calc_str($calc_get , $i+1) == "(") {
		# code...
	}*/
}

echo $calc_add_multi;

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

//һ���ڂȤ������ڤ���ʽ�Ȥ��΁I��Ȥ�ȡ�ä���
function calc_kakko($string){
	if (strpos($string , ")") != False) {
		$get = substr($string , 0 , strpos($string , ")"));
		$result[0] = substr($get , 0 , strrpos($get , "("));
		$result[1] = substr($get , strrpos($get , "(")+1);
		$result[2] = substr($string , 0 , strpos($string , ")")+1);
		$string = $result[0].array_calc($result[1]).$result[2];
		return calc_kakko($string);
		// return $string;
	}else{
		return $string;
	}
}


// һ���ڂȤ������ڤ�Ӌ�㤹��
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

echo calc_kakko($calc_add_multi);


