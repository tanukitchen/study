<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title>入力フォーム</title>
</head>
<body>
<form action="form_confirm.php" method="post">
名前：<br />
<input type="text" name="name" size="30" value="<?php echo $_SESSION['name']; ?>" /><br />
<?php if($_SESSION["name"] == "" && $_SESSION["nothing"] == "nothing"): ?>
<p style="color: red; font-weight: bold;">入力されていません。</p><br>
<?php endif; ?>
メールアドレス：<br />
<input type="text" name="mail" size="30" value="<?php echo $_SESSION['mail']; ?>" /><br />
<?php if($_SESSION["mail"] == "" && $_SESSION["nothing"] == "nothing"): ?>
<p style="color: red; font-weight: bold;">入力されていません。</p><br>
<?php endif; ?>
コメント：<br />
<textarea name="comment" cols="30" rows="5"><?php echo $_SESSION['comment']; ?></textarea><br />
<?php if($_SESSION["comment"] == "" && $_SESSION["nothing"] == "nothing"): ?>
<p style="color: red; font-weight: bold;">入力されていません。</p><br>
<?php endif; ?>
<br />
<input type="submit" value="登録する" />
</form>
</body>
</html>