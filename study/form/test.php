

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


	// [)(] or [)n] or [n(] だったら間に"*"を入れる処理
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

// 括弧がなくなるまで計算する
$calc_get = calc_kakko($calc_add_multi);
$calc_len = strlen($calc_get);

// 括弧がなくなった計算式を配列に入れる
for ($i = 0; $i < $calc_len; $i++) {
	$calc_str = substr($calc_get , $i , 1);
	if (preg_match("/^[0-9]+$/", $calc_str)) {
		$calc_array[$num] .= $calc_str;
	}else{
		$num++;
		$calc_array[$num] .= $calc_str;
		$num++;
	}
}

// 配列の添字整理
$calculating_array = array_values($calc_array);


/*================================================== * , / , + , - の処理 ==================================================*/

for($i = 0; $i < count($calculating_array); $i++) {
	switch ($calculating_array[$i]) {
		case "*":
		case "/":
		$calc_after_array[get_last_key($calc_after_array)] = $calc_symbol[$calculating_array[$i]]($calc_after_array[get_last_key($calc_after_array)], $calculating_array[$i+1]);
		$i++;
			break;
		default:
			$calc_after_array[] = $calculating_array[$i];
			break;
	}
}

// var_dump($calc_after_array);

for($i = 0; $i < count($calc_after_array); $i++) {
	switch ($calc_after_array[$i]) {
		case "+":
		case "-":
		$calc_result[get_last_key($calc_result)] = $calc_symbol[$calc_after_array[$i]]($calc_result[get_last_key($calc_result)], $calc_after_array[$i+1]);
		$i++;
			break;
		default:
			$calc_result[] = $calc_after_array[$i];
			break;
	}
}

// var_dump($calc_result);

echo "答え：".$calc_result[0];

/*================================================== *,/,+,- の処理 ==================================================*/

// function
// ========================================================

// 文字列を切り取る処理
function calc_str($string , $num){
	return substr($string , $num , 1);
}

// 配列の最後の要素のキーを取得する処理
function get_last_key($array){
	return count($array)-1;
}

// 配列の中身を記号に沿って計算する処理
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
			case "*":
			case "/":
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

// 括弧内の数値及び記号を取り出す処理
function calc_kakko($string){
	if (preg_match("/[(]/" , $string)) {
		$get = substr($string , 0 , strpos($string , ")"));
		$result[0] = substr($get , 0 , strrpos($get , "("));
		$result[1] = substr($get , strrpos($get , "(")+1);
		$result[2] = substr($string , strpos($string , ")")+1);
		$string = $result[0].array_calc($result[1]).$result[2];
		return calc_kakko($string);
	}
	return $string;
}

?>

	</section>
</body>
</html>