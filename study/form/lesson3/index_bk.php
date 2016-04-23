

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
$calc_length = strlen($calc_get);
for ($i = 0; $i < $calc_length; $i++) {
	$calcstr = substr($calc_get , $i , 1);
	if (!preg_match("/^[0-9]+$/", $calcstr)) {

		$calc[] = substr($calc_get , 0 , $i);
		$calc_get = substr($calc_get , $i);
		$calc[] = substr($calc_get , 0 , 1);
		$calc_get = substr($calc_get , 1);
		// $iを0にするかwhile文を使う？
		// $calc[] = substr($calc_get , 0 , $i);
	}
}

var_dump($calc);
// var_dump($calc_get);

/*		if (preg_match("/^[0-9]+$/", $calcstr[$i])) {
			var_dump($calcstr[$i]);

		}else{
			echo "null";*/

// preg_match("/^[0-9]+$/", $calcstr[$i])
 ?>

<!-- ===================================

1.数式を1つずつ分解する
		記号から前の文字列を取得
		記号から前の文字列を削除
		削除した残りの文字列を変数に上書きする
2.数字と記号に分ける
	123+456*789 => "123" "+" "456" "*" "789"
3.乗算、除算を優先的に計算する

=================================== -->

	</section>
</body>
</html>