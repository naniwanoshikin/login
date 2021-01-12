<?php
session_start(); // ログイン・ログアウト機能
require_once('../app/fun_logic.php'); // ログイン・ログアウト機能

// 直でアクセスした場合、
if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('ちゃんとマイページにアクセスしましょう');
}
// セッション（有効期限24分）が切れていたら、
if (!UserLogic::checkLogin()) {
  exit('セッションが切れましたので再度ログインし直してください');
}
// ログアウトする
UserLogic::logout();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>ログアウト</title>
</head>

<body>

  <h2>ログアウト完了</h2>
  <p>ログアウトしました！</p>
  <a href="loginForm.php">ログイン画面へ</a>

</body>

</html>