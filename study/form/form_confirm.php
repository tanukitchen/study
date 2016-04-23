<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>確認画面</title>
</head>
<body>
<?php

$_SESSION["name"] = $_POST["name"];
$_SESSION["mail"] = $_POST["mail"];
$_SESSION["comment"] = $_POST["comment"];

if ($_SESSION["name"] == "" || $_SESSION["mail"] == "" || $_SESSION["comment"] == "") {
	$_SESSION["nothing"] = "nothing";
	header( "Location: http://192.168.5.175:20080/study/form/form.php" ) ;
}else{
	$_SESSION["nothing"] = "";
	echo "<p>入力内容をご確認ください。お間違いはございませんか？</p><br>\n";
	echo "<p>お名前：<strong>".$_SESSION["name"]."</strong></p><br>\n";
	echo "<p>メールアドレス：<strong>".$_SESSION["mail"]."</strong></p><br>\n";
	echo "<p>コメント：<strong>".$_SESSION["comment"]."</strong></p><br>\n";
}

 ?>


<form action="result.php" method="post" accept-charset="utf-8">
	<input type="submit" value="登録">
</form>
<form action="form.php" method="post" accept-charset="utf-8">
	<input type="submit" value="戻る">
</form>


</body>
</html>