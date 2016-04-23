<?php

$cal = $_GET["cal"];



if ($cal == "") {
	$cal = date('Ym');
}


var_dump($cal);


 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>
<body>
	<p><a href="?cal=201603">＜＜</a>月<a href="?cal=201605">＞＞</a></p>
</body>
</html>


<!--

201612や201601の時に次に遷移する方法
年月を秒数に変換して、前月なら1日、来月なら31日分加減して、その秒数から年月を取得する。





 -->