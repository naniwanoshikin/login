<?php

// エスケープ
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * CSRF対策：トークン生成
 *
 * @param void
 * @return string $csrf_token
 */
function setToken()
{
  $csrf_token = bin2hex(random_bytes(32));
  $_SESSION['token'] = $csrf_token;
  return $csrf_token;
}
// トークンチェック
function validateToken()
{
  $token = filter_input(INPUT_POST, 'token');
  if (!isset($_SESSION['token']) || $token !== $_SESSION['token']) {
    exit('不正なリクエスト（validateToken）');
  }
  unset($_SESSION['token']);
}