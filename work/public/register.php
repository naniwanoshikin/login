<?php
session_start(); // CSRF対策
require_once('../app/functions.php'); // CSRF対策
require_once('../app/fun_logic.php'); // ユーザ情報登録機能

validateToken(); // CSRF対策

// バリデーション
$error = []; // エラーメッセージ
if (!$username = filter_input(INPUT_POST, 'username')) {
  $error[] = 'ユーザー名を入力してください';
}
if (!$mail = filter_input(INPUT_POST, 'mail')) {
  $error[] = 'アドレスを入力してください';
}
$pass = filter_input(INPUT_POST, 'pass');
if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $pass)) {
  $error[] = 'パスワードは英数字で8~100字にしてください';
}
$pass_conf = filter_input(INPUT_POST, 'pass_conf');
if (!$pass_conf) {
  $error[] = 'パスワード確認を入力してください';
}
if ($pass_conf && $pass !== $pass_conf) {
  $error[] = '確認用パスワードと異なっています';
}
if (count($error) ===  0) {
  // 登録失敗したら、
  if (!UserLogic::createUser($_POST)) {
    $error[] = '登録に失敗しました';
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>新規登録</title>
</head>

<body>

  <h2>新規登録</h2>

  <?php if (count($error) != 0) : ?>
    <?php foreach ($error as $e) : ?>
      <p class="err"><?= $e ?></p>
    <?php endforeach ?>
  <?php else : ?>
    <p>ユーザー登録が完了しました</p>
  <?php endif ?>

  <p><a href="./index.php">戻る</a></p>
</body>

</html>