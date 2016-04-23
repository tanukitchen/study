

 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>勉強</title>
</head>
<body>
	<section>
<?php
$calc_get = $_POST["calcarea"];
// $calc_get = "(((1+2)+3)+4)";
$calc_len = strlen($calc_get);

// 数式で使う文字かどうかのエラーチェック
if (preg_match("/[0-9]/", $calc_get) == 0) {		// 数値がなく記号のみ
	exit("数値を入れてください");
}elseif (substr_count($calc_get , "(") != substr_count($calc_get , ")")) {		// 括弧の始終の数が等しくない
	exit("括弧の数が合っていません");
}elseif(preg_match("/[,]/", $calc_get)){// 小数点がカンマ
	exit("カンマを使わないでください。小数点はドットにしてください。");
}elseif (preg_match("/[\+|\-|\*|\/|(|)]/", $calc_get) == 0) {		// 記号がない
	exit("計算できません");
}elseif(preg_match("/[^\+|\-|\*|\/|0-9|(|)|\.]/", $calc_get)){		// 数式に使わない文字
	exit("数式以外の文字を入れないでください");
}elseif(preg_match("/\([\+|\*|\/]/", $calc_get) || preg_match("/[\+|\-|\*|\/]\)/", $calc_get) ){		// 正しくない数式
	exit("数式が正しくありません");
}elseif(preg_match("/[\+|\-|\*|\/][\+|\*|\/]/", $calc_get) || preg_match("/[\+|\-|\*|\/]\)/", $calc_get) ){		// 正しくない数式
	exit("数式が正しくありません");
}

$calc_add_multi = "";
for ($i=0; $i < $calc_len; $i++) {
	$calc_add_multi .= calc_str($calc_get , $i);
	// [)(] or [)n] or [n(]
	switch (true) {
		case calc_str($calc_get , $i) == ")" && calc_str($calc_get , $i+1 ) == "(":
		case calc_str($calc_get , $i) == ")" && preg_match("/^[0-9]+$/", calc_str($calc_get , $i+1)):
		case preg_match("/^[0-9]+$/", calc_str($calc_get , $i)) && calc_str($calc_get , $i+1) == "(":
			$calc_add_multi .= "*";
			break;
	}
}

$test2 = calc_kakko($calc_add_multi);

$test3 = func_calc(neg_value(find_point_int($test2)));

echo $test3;

// function ->
//==============================================================

// 文字列を切り取る処理
function calc_str($string , $num){
	return substr($string , $num , 1);
}

// 小数点のもの含む数値と記号を配列に分ける処理
function find_point_int($str){
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
		}elseif($array[0] == "-" && preg_match("/[0-9]/" , $array[$i+1])){
			$array[$i] = strval($array[$i]).strval($array[$i+1]);
			unset($array[$i+1]);
			$i += 1;
		}
	}
	$result = array_values($array);
	return $result;
}

// 小数点がなくなるまで10倍する処理
/*function ten_power($array){
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
	// var_dump($ten_product);
	$result = strval(func_calc($ten_product) / pow(10, $k));
	return $result;
}*/

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
			case "*":
			case "/":
			$array_calclating[count($array_calclating)-1] = $calc_symbol[$array[$i]]($array_calclating[count($array_calclating)-1] , $array[$i+1]);
			$i++;
				break;
			default:
				$array_calclating[] = $array[$i];
				break;
		}
	}
	// var_dump($array_calclating);
	for($i = 0; $i < count($array_calclating); $i++) {
		switch ($array_calclating[$i]) {
			case "+":
			case "-":
			$result[count($result)-1] = $calc_symbol[$array_calclating[$i]]($result[count($result)-1] , $array_calclating[$i+1]);
			$i++;
				break;
			default:
				$result[] = $array_calclating[$i];
				break;
		}
	}
	// var_dump($result);
	return $result[0];
}

// 括弧内の数値及び記号を取り出す処理
function calc_kakko($string){
	if (preg_match("/[(]/" , $string)) {
		$get = substr($string , 0 , strpos($string , ")"));
		$result[0] = substr($get , 0 , strrpos($get , "("));
		$result[1] = substr($get , strrpos($get , "(")+1);
		$result[2] = substr($string , strpos($string , ")")+1);
		// var_dump($result);
		$calc_result = func_calc(neg_value(find_point_int($result[1])));
		$string = $result[0].$calc_result.$result[2];
		return calc_kakko($string);
	}
	return $string;
}



// <- function
//==============================================================
?>

	</section>
</body>
</html>