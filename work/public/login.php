<?php
session_start(); // ログイン失敗時とユーザー一致時のバリデーションのsession用
require_once('../app/fun_logic.php'); // login静的メソッド

$mail = filter_input(INPUT_POST, 'mail');
$pass = filter_input(INPUT_POST, 'pass');

// ログイン時 バリデーション
$error = []; // エラーメッセージ
if (!$mail) {
  $error['mail'] = 'アドレスを入力してください';
}
if (!$pass) {
  $error['pass'] = 'パスワードを入力してください';
}
// 失敗（未入力）
if (count($error) > 0) {
  $_SESSION = $error; // SESSIONにエラーを入れる
  header('Location: loginForm.php');
  return;
}
// 失敗（ユーザが一致しない）
if (!UserLogic::login($mail, $pass)) {
  header('Location: loginForm.php');
  return;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>ログイン完了</title>
</head>

<body>

  <h2>ログイン完了</h2>
  <p>ログインしました！</p>

  <p><a href="./index.php">マイページへ</a></p>

</body>

</html>