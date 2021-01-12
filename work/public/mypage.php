<?php
session_start();
require_once('../app/fun_logic.php'); // ログインチェック用
require_once('../app/functions.php'); // エスケープ用

// ログイン失敗（新規登録へ戻す）
if (!UserLogic::checkLogin()) {
  $_SESSION['login_err'] = 'ユーザ登録をしてからログインしてください';
  header('Location: index.php');
  return;
}
// ログイン成功時（loginメソッドがtrue）のDBユーザー情報
$users = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>マイページ</title>
</head>

<body>

  <h2>マイページ</h2>
  <!-- DBのユーザー情報 -->
  <p>ログインユーザー：<?= h($users['uname']) ?></p>
  <p>メールアドレス：<?= h($users['email']) ?></p>

  <form action="logout.php" method="POST">
    <input type="submit" name="logout" value="ログアウト">
  </form>

</body>

</html>