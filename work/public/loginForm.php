<?php
session_start(); // バリデーションのsession用（login.phpより）
// var_dump($_SESSION);
require_once('../app/fun_logic.php'); // checkLogin用

// ログイン済なら、
if (UserLogic::checkLogin()) {
  header('Location: mypage.php');
  return;
}

// ログイン失敗時（login()）
$error = $_SESSION; // エラーメッセージ
$_SESSION = array(); // sessionの中身（配列）を消す（初期化）
session_destroy(); // sessionファイルを消す

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>ログイン画面</title>
</head>

<body>

  <h2>ログイン画面</h2>
  <!-- ログイン:login() 失敗時 -->
  <?php if (isset($error['msg'])) : ?>
    <p class="err"><?= $error['msg']; ?></p>
  <?php endif; ?>

  <form action="login.php" method="POST">
    <p>
      <label for="mail">Email：</label>
      <input type="email" name="mail">
      <?php if (isset($error['mail'])) : ?>
    <p class="err"><?= $error['mail']; ?></p>
  <?php endif; ?>
  </p>

  <p>
    <label for="pass">Password：</label>
    <input type="password" name="pass">
    <?php if (isset($error['pass'])) : ?>
  <p class="err"><?= $error['pass']; ?></p>
<?php endif; ?>
</p>

<p>
  <input type="submit" value="ログイン">
</p>

  </form>

  <p><a href="index.php">新規登録はこちら</a></p>

</body>

</html>