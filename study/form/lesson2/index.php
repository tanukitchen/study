

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
$calc_get = $_POST["calcarea"]."+e";
$i = 0;
while ($calc_get != "e") {   //  <= 条件にsubstr($calc_get , $i , 1)を使えば最後まで回した時に値を返さずfalseになるのでループから抜けられる
	$calcstr = substr($calc_get , $i , 1);  //<= foreach文やforでもできる。文字列を１文字ずつ配列の同じ要素に入れる処理（「.」など）を書けば、文字列なので連結されて１つの文字列となる。
	if (!preg_match("/^[0-9]+$/", $calcstr)) {

		$calc_array[] = substr($calc_get , 0 , $i);
		$calc_array[] = substr($calc_get , $i , 1);
		$calc_get = substr($calc_get , $i+1);		//<= [$i+1]の部分は上の２行の文字数を足せば取得することができるので不要になる
		$i = 0;
	}else{
	$i++;
	}
}

array_pop($calc_array);  //<= 配列から要素を取り除く
$calc_count = count($calc_array);
// var_dump($calc_array);

/*		$calc_key = array_search("/" , $calc_array);
		$calc_division = intval($calc_array[$calc_key-1])/intval($calc_array[$calc_key+1]);
		$calc_array[$calc_key-1] = strval($calc_division);
		$calc_array[$calc_key] = "";
		$calc_array[$calc_key+1] = "";
		// $calc_array = array_merge($calc_array);
		$calc_array = array_filter($calc_array , "strlen");
		$calc_array = array_values($calc_array);
*/


while ($calc_count != 1) {
	if (in_array("/" , $calc_array)) { // <= ifよりもcaseのほうが処理が速いので、処理が長くなる時はforeachにする。
		// $calc_kigou = preg_match(/(\/)/ , $calc_array);
		$calc_key = array_search("/" , $calc_array);
		$calc_division = intval($calc_array[$calc_key-1])/intval($calc_array[$calc_key+1]);
		$calc_array[$calc_key-1] = strval($calc_division); // <= 数値、記号、数値を条件にして一気に取り出し、別の配列に格納して配列の中身の記号を加減算のみにする。trueなら乗除算を計算して格納。falseならそのまま格納。
		$calc_array[$calc_key] = "";
		$calc_array[$calc_key+1] = "";
		$calc_array = array_filter($calc_array , "strlen"); // <= 処理は共通しているのでfunctionにして外で処理させる。
		$calc_array = array_values($calc_array);
		$calc_count = count($calc_array);
	}elseif(in_array("*" , $calc_array)){
		$calc_key = array_search("*" , $calc_array);
		$calc_multiplication = intval($calc_array[$calc_key-1])*intval($calc_array[$calc_key+1]);
		$calc_array[$calc_key-1] = strval($calc_multiplication);
		$calc_array[$calc_key] = "";
		$calc_array[$calc_key+1] = "";
		$calc_array = array_filter($calc_array , "strlen");
		$calc_array = array_values($calc_array);
		$calc_count = count($calc_array);
	}elseif (in_array("-" , $calc_array)) {
		$calc_key = array_search("-" , $calc_array);
		$calc_subtraction = intval($calc_array[$calc_key-1])-intval($calc_array[$calc_key+1]);
		$calc_array[$calc_key-1] = strval($calc_subtraction);
		$calc_array[$calc_key] = "";
		$calc_array[$calc_key+1] = "";
		$calc_array = array_filter($calc_array , "strlen");
		$calc_array = array_values($calc_array);
		$calc_count = count($calc_array);
	}elseif (in_array("+" , $calc_array)) {
		$calc_key = array_search("+" , $calc_array);
		$calc_addition = intval($calc_array[$calc_key-1])+intval($calc_array[$calc_key+1]);
		$calc_array[$calc_key-1] = strval($calc_addition);
		$calc_array[$calc_key] = "";
		$calc_array[$calc_key+1] = "";
		$calc_array = array_filter($calc_array , "strlen");
		$calc_array = array_values($calc_array);
		$calc_count = count($calc_array);
		}
}

// var_dump($calc_array);
echo $calc_array[0];

// 計算が終わった配列を消す => ggrks
// $calc_array[$calc_key-1]のほうに計算結果を入れなおす => ふつうに代入する
// $calc_array[$calc_key+1]が空なので整理する => array_merge でできるらしい


/*while ($calc_count != 1) {
	$calc_kigou = preg_match(/[\/]/ , $calc_array);
	if ($calc_kigou == ("*" || "/")) {
		$calc_key = array_search(preg_match(/(\/)/) , $calc_array);
		$calc_division = intval($calc_array[$calc_key-1])/intval($calc_array[$calc_key+1]);
	}else{
		return false;
	}
}*/
// preg_match(/[\/]/ , $calc_array , $calc_test);
// echo $calc_test;

// echo $calc_get."<br>\n";
// var_dump($calc_array)."\n";
// echo count($calc_array)."<br>\n";
// echo $calc_division;

?>





<!-- <php
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
?> -->

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