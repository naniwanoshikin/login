<?php

require_once('env.php');

// DB接続
function connect()
{
  $host   = DB_HOST;
  $db     = DB_NAME;
  $user   = DB_USER;
  $pass   = DB_PASS;

  try {
    $pdo = new PDO(
      "mysql:host=$host; dbname=$db; charset=utf8mb4",
      $user,
      $pass,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]
    );
    return $pdo;
  } catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
  };
}
