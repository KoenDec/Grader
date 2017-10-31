<?php
require_once('graderdb.php');

class Login {

  public static function isLoggedIn() {
  $userDAO = new UserDAO();
    if (isset($_COOKIE['GID'])) {

      if ($userDAO->getLoggedInUserId(sha1($_COOKIE['GID']))){
        $userid = $userDAO->getLoggedInUserId(sha1($_COOKIE['GID']))->userId;

        if (isset($_COOKIE['GID_'])) {
          return $userid;
        } else {
          $cstrong = True;
          $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
          $userDAO->insertNewLoginToken($userid, sha1($token));
          $userDAO->removeLoginToken(sha1($_COOKIE['GID']));

          setcookie('GID', $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, true);
          setcookie('GID_', '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, true);

          return $userid;
        }
      }
    }
    return false;
  }
}
?>
