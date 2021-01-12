<?php
require_once('dbc.php');

class UserLogic
{
  /**
   * ユーザ情報を登録
   * @param array $user：ユーザデータ
   * @return bool $result
   */
  public static function createUser($user)
  {
    $result = false;
    $sql = 'INSERT INTO users (uname, email, pass) VALUES (?, ?, ?)';
    $arr = [];
    $arr[] = $user['username'];
    $arr[] = $user['mail'];
    $arr[] = password_hash($user['pass'], PASSWORD_DEFAULT);
    try {
      $stmt = connect()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result;
    } catch (\Exception $e) {
      echo $e;
      return $result;
    };
  }

  /**
   * ログイン機能
   * @param string $mail 入力値
   * @param string $pass 入力値
   * @return bool $result
   */
  public static function login($mail, $pass)
  {
    $result = false;
    // DBのユーザ情報取得
    $users = self::getUserByMail($mail);

    // ユーザー情報がない場合
    if (!$users) {
      $_SESSION['msg'] = 'Emailが一致しません';
      return $result;
    }
    // パスワードが一致した場合
    if (password_verify($pass, $users['pass'])) {
      // ログイン成功
      session_regenerate_id(true); // ハイジャック対策
      $_SESSION['login_user'] = $users; // ユーザー情報を保持（マイページ用）
      $result = true;
      return $result;
    }
    // パスワードが一致しない場合
    $_SESSION['msg'] = 'Passwordが一致しません';

    return $result;
  }

  /**
   * DBのユーザデータを取得（mailから検索）
   * @param string $mail
   * @return array|bool $user|false
   */
  public static function getUserByMail($mail)
  {
    $sql = 'SELECT * FROM users WHERE email = ?';
    $arr = [];
    $arr[] = $mail;
    try {
      $stmt = connect()->prepare($sql);
      $stmt->execute($arr);
      $user = $stmt->fetch();
      return $user;
    } catch (\Exception $e) {
      return false;
    };
  }

  /**
   * ログインチェック
   * @param void
   * @return bool $result
   */
  public static function checkLogin()
  {
    $result = false;
    // sessionにlogin_userとidあったらtrue
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }
    return $result;
  }

  /**
   * ログアウト
   */
  public static function logout()
  {
    $_SESSION = array();
    session_destroy();
  }
}
