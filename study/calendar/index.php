<?php session_start(); ?>


<?php

// 現在の年月を取得
if (empty($cal)) {
	$month = date(n);
}

// <if>「＜＜前月」をクリック
$month = $_POST["month"];
if ($month = "prev") {
	// 前月の末日を取得

	// 前月の「1日」の曜日を取得
	# code...
	// 前月を「空白のtdタグ」に出力
	# code...
// <elseif>「翌月＞＞」をクリック
}elseif ($month = "next") {
	# code...
// <else>クリックしない
}else{
	# code...
}


 ?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>カレンダー</title>
</head>

<body>
<form action="index.php" method="post" accept-charset="utf-8">
<table>
	<tbody>
		<tr>
<!--〔前提〕 「＜＜前月」,「空白のtdタグ」,「翌月＞＞」と「日 月 火 水 木 金 土」を含んだtableタグを書いておく。 -->
			<th><button type="submit" name="calendar" value="">＜＜前月</button></th>
			<th><?php echo $month."月"; ?></th>
			<th><button type="submit" name="calendar" value="next">翌月＞＞</button></th>
		</tr>
		<tr>
			<th>日</th>
			<th>月</th>
			<th>火</th>
			<th>水</th>
			<th>木</th>
			<th>金</th>
			<th>土</th>
		</tr>

	</tbody>
</table>
</form>


</body>
</html>