<?php
require_once('../php/graderdb.php');
require_once('../php/Login.php');

$userDAO = new UserDAO();
$notFoundErr = '{"Status":"Geen user gevonden"}';
$notLoggedInErr = '{"Status":"Niet ingelogd"}';
$notAuthorizedErr = '{"Status":"Onbevoegd"}';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if ($_GET['url'] == 'auth') {

  } else if ($_GET['url'] == 'students') {
    if (Login::isLoggedIn()) {
      $students = $userDAO->getAllStudents();
      echo json_encode($students);
      http_response_code(200);
    } else {
      echo $notLoggedInErr;
      http_response_code(401);
    }
  } else if ($_GET['url'] == 'studentInEducation') {
    if (Login::isLoggedIn()) {
      $userid = Login::isLoggedIn();
      if (isset($_GET['edu'])) {
        $edu = $_GET['edu'];
        //if (!isStudent($userid)) {
          $studentsInEdu = $userDAO->getAllStudentsInEducation($_GET['edu']);
          echo json_encode($studentsInEdu);
          http_response_code(200);
        /*} else {
          echo $notAuthorizedErr;
          http_response_code(401);
        }*/
      } else {
        echo '{"Status":"No edu set"}';
        http_response_code(401);
      }
    } else {
      echo $notLoggedInErr;
      http_response_code(401);
    }
  } else if ($_GET['url'] == 'currentUser') {
    if (Login::isLoggedIn()) {
      if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $userid = $userDAO->getLoggedInUserId(sha1($token));
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
  } else if ($_GET['url'] == 'studentReport') {
    if (Login::isLoggedIn()) {
      if (isset($_GET['id'])) {
        $studentId = $_GET['id'];

          $rapport = $userDAO->getRapporten($studentId)[0]; // TODO students have more than 1 report (old reports are not deleted)
          $modules = $userDAO->getRapportmodules($rapport->id);

          $report = (object)[
              'id' => $rapport->id,
              'modules' => array(),
              'commentaarAlgemeen' => utf8_encode($rapport->commentaarAlgemeen),
              'commentaarKlassenraad' => utf8_encode($rapport->commentaarKlassenraad)
          ];

          foreach($modules as $rapportmodule){
              $module = $userDAO->getModule($rapportmodule->moduleId);

              $moduleObjToPush = (object)[
                  'id' => $module->id,
                  'naam' => $module->name,
                  'doelstellingscategories' => array(),
                  'commentaar' => utf8_encode($rapportmodule->commentaar)
              ];

              $doelstellingscategories = $userDAO->getDoelstellingscategoriesInModule($module->id);

              foreach($doelstellingscategories as $doelstellingscategorie){

                  $doelstellingscategorieObjToPush = (object)[
                      'id' => $doelstellingscategorie->id,
                      'name' => utf8_encode($doelstellingscategorie->name),
                      'doelstellingen' => array()
                  ];

                  $doelstellingen = $userDAO->getDoelstellingenInDoelstellingscategorie($doelstellingscategorie->id);

                  foreach($doelstellingen as $doelstelling) {
                      $ratingObj = $userDAO->getRating($rapport->id, $doelstelling->id);
                      $score = null;
                      $opmerking = null;
                      if($ratingObj != null) {
                          $score = $ratingObj->score;
                          $opmerking = $ratingObj->opmerking;
                      }

                      $doelstellingObjToPush = (object)[
                          'id' => $doelstelling->id,
                          'name' => utf8_encode($doelstelling->name),
                          'score' => $score,
                          'opmerking' => $opmerking
                      ];

                      array_push($doelstellingscategorieObjToPush->doelstellingen, $doelstellingObjToPush);
                  }

                  array_push($moduleObjToPush->doelstellingscategories, $doelstellingscategorieObjToPush);
              }

              array_push($report->modules, $moduleObjToPush);
          }

        echo json_encode($report);

        http_response_code(200);
      } else {
        echo $notFoundErr;
        http_response_code(405);
      }
    } else {
      echo $notLoggedInErr;
      http_response_code(401);
    }
  } else if ($_GET['url'] == 'student') {
    if (Login::isLoggedIn()) {
      if (isset($_GET['id'])) {
        $userid = $_GET['id'];
        $student = $userDAO->getUserById($userid);
        echo json_encode($student);
      } else {
        echo $notFoundErr;
        http_response_code(405);
      }
    } else {
      echo $notLoggedInErr;
      http_response_code(401);
    }
  } else if ($_GET['url'] == 'opleidingen') {
    if (Login::isLoggedIn()) {
      $edus = $userDAO->getAllEducations();
      echo json_encode($edus);
      http_response_code(200);
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
  } else if ($_GET['url'] == 'updateUser') {
    $postBody = file_get_contents('php://input');
    $postBody = json_decode($postBody);

    $firstname = $postBody->firstname;
    $lastname = $postBody->lastname;
    $email = $postBody->email;

    $id = Login::isLoggedIn();
    if (Login::isLoggedIn()) {
      $userDAO->updateUser($firstname, $lastname, $email , $id);
      echo '{"Status":"User updated"}';
      http_response_code(200);
    } else {
      echo $notLoggedInErr;
      http_response_code(401);
    }
  } else if ($_GET['createModule']) {
    
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
