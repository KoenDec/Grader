<?php
require_once('../graderdb.php');

$userDAO = new UserDAO();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if ($_GET['url'] == 'auth') {
<<<<<<< HEAD

  } else if ($_GET['url'] == 'users') {
=======
<<<<<<< HEAD

  } else if ($_GET['url'] == 'students') {
    if ($userDAO->getToken(sha1($_COOKIE['GID']))) {
      $students = $userDAO->getAllStudents();
      echo json_encode($students);
      http_response_code(200);
    } else {
      echo json_encode('{"Status":"Unauthorized"}');
      http_response_code(401);
    }
=======
    echo {'geegeges':'nice'}
  } else if ($_GET['urll'] == 'users') {
>>>>>>> 97dc6562c3a80efb2253619cc3401a04c7c0bf6c

>>>>>>> e9b7d576f433b05144bf5d675a49d238f78ac9b5
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_GET['url'] == 'auth') {
    $postBody = file_get_contents('php://input');
    $postBody = json_decode($postBody);

    $username = $postBody->username;
    $password = $postBody->password;

    if ($userDAO->getUser($username)) {
      if ($password == $userDAO->getUser($username)->password) {// TODO hash PW!
        $cstrong = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
        $user_id = $userDAO->getUser($username)->id;
        $userDAO->insertNewLoginToken($user_id, sha1($token));
        setcookie("GID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, false);
        setcookie("GID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
      } else {
        http_response_code(401);
      }
    } else {
      http_response_code(401);
    }
  }

} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  if ($_GET['url'] == 'auth') {
    if (isset($_GET['token'])) {
      if ($userDAO->getToken(sha1($_GET['token']))) {
        $userDAO->removeLoginToken(sha1($_GET['token']));
        echo '{ "Status": "Success" }';
        http_response_code(200);
      } else {
        echo '{ "Error": "Invalid token" }';
        http_response_code(400);
      }
    } else {
      echo '{ "Error": "Malformed request" }';
      http_response_code(400);
    }
  }
} else {
  http_response_code(405);
}


?>
