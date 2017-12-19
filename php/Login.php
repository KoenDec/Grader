<?php
require_once('graderdb.php');

class Login {

  public static function isLoggedIn() {
    $userDAO = new UserDAO();
    if ($userDAO->getLoggedInUserId($userid)) {
      
      if ($userDAO->getLoggedInUserId(sha1($_COOKIE['GID']))){
        $userid = $userDAO->getLoggedInUserId(sha1($_COOKIE['GID']))->userId;
        return $userid;
      }
    }
    return false;
  }
}
?>
