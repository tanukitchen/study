<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title>入力フォーム</title>
</head>
<body>

<h1>下記内容を送信いたしました。</h1>
<?php

	echo "<p>お名前：<strong>".$_SESSION["name"]."</strong></p><br>\n";
	echo "<p>メールアドレス：<strong>".$_SESSION["mail"]."</strong></p><br>\n";
	echo "<p>コメント：<strong>".$_SESSION["comment"]."</strong></p><br>\n";

 ?>

</body>
</html>