<?php
require_once('../graderdb.php');
require_once('api.php');
require_once('../Login.php');

$userDAO = new UserDAO();
$notFoundErr = json_encode('{"Status":"Geen user gevonden"}');
$notLoggedInErr = json_encode('{"Status":"Niet ingelogd"}');
$notAuthorized = json_encode('{"Status":"Onbevoegd"}');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if ($_GET['url'] == 'auth') {

  } else if ($_GET['url'] == 'students') {
    if ($userDAO->getToken(sha1($_COOKIE['GID']))) {
      $userid = $userDAO->getLoggedInUserId(sha1($_COOKIE['GID']));
      if (!ApiController::isStudent($userid)) {
        $students = $userDAO->getAllStudents();
        echo json_encode($students);
        http_response_code(200);
      } else {
        echo $notAuthorized;
        http_response_code(401);
      }
    } else {
      echo $notLoggedInErr;
      http_response_code(401);
    }
  } else if ($_GET['url'] == 'studentInEducation') {
    if ($userDAO->getToken(sha1($_COOKIE['GID']))) {
      $userid = $userDAO->getLoggedInUserId(sha1($_COOKIE['GID']));
      if (!ApiController::isStudent($userid)) {
        $studentsInEdu = $userDAO->getAllStudentsInEducation($_GET['edu']);
        echo json_encode($studentsInEdu);
        http_response_code(200);
      } else {
        echo $notAuthorized;
        http_response_code(401);
      }
    } else {
      echo $notLoggedInErr;
      http_response_code(401);
    }
  } else if ($_GET['url'] == 'currentUser') {
    if (Login::isLoggedIn()) {
      if (isset($_GET['id'])) {
        $userid = $_GET['id'];
        $currentUser = $userDAO->getUserById($userid);
        echo json_encode($currentUser);
      } else {
        echo $notFoundErr;
        http_response_code(405);
      }
    } else {
      echo $notLoggedInErr;
      http_response_code(401);
    }
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
        echo '{ "Status": "Logged out" }';
        http_response_code(200);
      } else {
        echo '{ "Status": "Invalid token" }';
        http_response_code(400);
      }
    } else {
      echo '{ "Status": "Malformed request" }';
      http_response_code(400);
    }
  }
} else {
  http_response_code(405);
}


?>
