<!-- ===============================================================
【ミス部分】
・変数が関数の外にでてるので値が受け取れない。
	変数を関数外で使うなら引数を入れる→answer($a,$b,$shisoku)
=============================================================== -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>勉強</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<section>
		<?php
		$a = $_POST["a"];
		$b = $_POST["b"];
		$shisoku = $POST_["shisoku"];
		echo $a;
		echo $b;
		function answer(){
			switch ($shisoku) {
				case "＋":
					return $a+$b;
					break;
				case "－":
					return $a-$b;
					break;
					case "×":
					return $a*$b;
					break;
					case "÷":
					return $a/$b;
					break;
				default:
					return "正確に入力してください。";
					break;
			}
		};
		echo $a." ".$shisoku." ".$b." = ".answer();
		 ?>
	</section>
</body>
</html>