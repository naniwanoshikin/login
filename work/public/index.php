<?php
session_start(); // CSRF対策
require_once('../app/functions.php'); // CSRF対策
require_once('../app/fun_logic.php'); // checkLogin用

// ログイン済なら、
if (UserLogic::checkLogin()) {
  header('Location: mypage.php');
  return;
}

// ログイン失敗（mypageから戻ってきた）
$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']); // ２回目入ると$_SESSION[login_err]は消える

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>新規登録</title>
</head>

<body>

  <h2>新規登録</h2>

  <!-- ログイン失敗時 -->
  <?php if (isset($login_err)) : ?>
    <p class="err"><?= $login_err; ?></p>
  <?php endif; ?>

  <form action="register.php" method="POST">
    <p>
      <label for="username">ユーザー名：</label>
      <input type="text" name="username" id="username">
    </p>
    <p>
      <label for="mail">Email：</label>
      <input type="email" name="mail" id="mail">
    </p>
    <p>
      <label for="pass">Password：</label>
      <input type="password" name="pass" id="pass">
    </p>
    <p>
      <label for="pass_conf">Password 確認：</label>
      <input type="password" name="pass_conf" id="pass_conf">
    </p>
    <!-- CSRF対策 -->
    <input type="hidden" name="token" value="<?= h(setToken()); ?>">
    <p>
      <input type="submit" value="登録する">
    </p>
  </form>

  <p><a href="loginForm.php">ログイン画面へ</a></p>

</body>

</html>