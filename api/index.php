<?php
require_once('../graderdb.php');
//require_once('api.php');
require_once('../Login.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,Authorization,Accept,X-Requested-With');

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
  } else if ($_GET['url'] == 'studentsInEducation') {
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
        $userid = $userDAO->getLoggedInUserId($_GET['token']);
        $currentUser =
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
        $studentid = $_GET['id'];
        $report = (object)[
          'modules' => array()
        ];

        $modules = $userDAO->getModulesFromStudent($studentid);
        foreach ($modules as $mod) {
          $modObj = new Module();
          $modObj->modName = $mod->name;

          echo "\n";
          echo json_encode($modObj);

          $doelstellingen = $userDAO->getDoelstellingenInModule($mod->id);
          foreach ($doelstellingen as $doel) {
            $doelObj = new Doel();
            $doelObj->doelName = $doel->name;

            echo "\n\t";
            echo json_encode($doelObj);

            $criteria = $userDAO->getCriteriaForDoelstelling($doel->id);
            foreach ($criteria as $crit) {
              $critObj = new Crit();
              $critObj->critName = $crit->weergaveTitel;

              echo "\n\t\t";
              echo json_encode($critObj);
              //array_push($doelObj->criteria, $critObj);
            }
            //array_push($modObj->doelstellingen, $doelObj);
          }
          array_push($report->modules, $modObj);
        }

        //echo json_encode($report);
        http_response_code(200);
        //$currentUserId = Login::isLoggedIn();
        /*if (ApiController::isTeacher($currentUserId)) {
          // TODO show eval possibilities
        } else {
          // TODO show student's report
        }*/
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
} else if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

  echo null;

  http_response_code(200);

} else {
  http_response_code(405);
}

  ////////////////////////
 /// HELPER FN //////////
////////////////////////
class Module {
  public $modName = '';
  public $doelstellingen = [];
}
class Doel {
  public $doelName = '';
  public $criteria = [];
}
class Crit {
  public $critName = '';
}

?>
