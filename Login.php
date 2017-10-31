<?php
require_once('graderdb.php');
$userDAO = new UserDAO();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($userDAO->getUser($username)) {
      if ($password == $userDAO->getUser($username)->password/*password_verify($password, $userDAO->getUser($username)->password)*/) {
          $cstrong = True;
          $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
          $user_id = $userDAO->getUser($username)->id;
          $userDAO->insertNewLoginToken($user_id, sha1($token));
          setcookie("GID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
          setcookie("GID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
      } else {
            echo 'Incorrect Password!';
      }
    } else {
        echo 'User not registered!';
    }
}

?>
<h1>Login to your account</h1>
<form action="login.php" method="post">
<input type="text" name="username" value="" placeholder="Username ..."><p />
<input type="password" name="password" value="" placeholder="Password ..."><p />
<input type="submit" name="login" value="Login">
</form>
