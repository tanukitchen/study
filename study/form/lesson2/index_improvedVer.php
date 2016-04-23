

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
$calc_len = strlen($calc_get);
$num = 0;


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
// var_dump($calc_array);

// echo $calc_symbol[$calc_array[1]]($calc_array[0] , $calc_array[2]);

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
	end($array);
	return key($array);
}

for($i = 0; $i < count($calc_array); $i++) {
	switch ($calc_array[$i]) {
		case "*":
		case "/":
		$calc_after_array[get_last_key($calc_after_array)] = $calc_symbol[$calc_array[$i]]($calc_after_array[get_last_key($calc_after_array)], $calc_array[$i+1]);
		$i++;
		// 計算が終わった要素は消さずに$i++で要素をとばす
			break;
		default:
			// array_push($calc_after_array, $calc_array[$i]);
			$calc_after_array[] = $calc_array[$i];
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


?>

	</section>
</body>
</html>