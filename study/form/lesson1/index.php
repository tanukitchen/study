<?php

// echo $a + $b; <= クリア
/*if($shisoku == "＋" or $shisoku == "－" or $shisoku == "×" or $shisoku == "÷"){
	echo $shisoku;
}; <= クリア
*/
function answer(){
	$a = intval($_POST["a"]);
	$b = intval($_POST["b"]);
	$shisoku = $_POST["shisoku"];
	switch ($shisoku) {
		case '＋':
			return $a + $b;
			break;
		case '－':
			return $a - $b;
			break;
		case '×':
			return $a * $b;
			break;
		case '÷':
			return $a / $b;
			break;
		default :
			return "間違っています";
	}
};
/*function answer($a , $b){
	return $a + $b;
}
echo answer($a,$b); <= クリア
*/

echo answer();
 ?>