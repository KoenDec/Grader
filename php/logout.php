<?php
include('graderdb.php');
include('Login.php');

$userDAO = new UserDAO();

if (!Login::isLoggedIn()) {
  die("Not logged in.");
}

if (isset($_POST['confirm'])) {
  if (isset($_POST['alldevices'])) {
    $userDAO->removeAllTokensFromUser(Login::isLoggedIn());
  } else {
    if (isset($_COOKIE['GID'])) {
      $userDAO->removeLoginToken(sha1($_COOKIE['GID']));
    }

    setcookie('GID', '1', time()-3600);
    setcookie('GID_', '1', time()-3600);
  }
}

?>
<h1>Logout of your account?</h1>
<form action="logout.php" method="post">
  <input type="checkbox" name="alldevices" value="alldevices"> Logout of all devices?<br />
  <input type="submit" name="confirm" value="Confirm"/>
</form>
