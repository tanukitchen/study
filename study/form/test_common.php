<?php

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
			$result[count($result)-1] = strval($result[count($result)-1]);
			$array[$i+1] = strval($array[$i+1]);
			$result[count($result)-1] = $calc_symbol[$array[$i]]($result[count($result)-1] , $array[$i+1]);
			$i++;
				break;
			default:
				$result[] = $array[$i];
				break;
		}
	}
	return $result;
}
 ?>