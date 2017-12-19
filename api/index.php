<?php
require_once('graderdb.php');
require_once('Login.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin,Content-Type");
header('Content-Type: application/json');

$userDAO = new UserDAO();
$notFoundErr = '{"Error":"Geen user gevonden"}';
$notLoggedInErr = '{"Error":"Niet ingelogd"}';
$notAuthorizedErr = '{"Error":" Onbevoegd"}';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET['url'] == 'auth') {

    } else if ($_GET['url'] == 'students') {
        //if (Login::isLoggedIn()) {
        $students = $userDAO->getAllStudents();
        echo json_encode($students);
        http_response_code(200);
        /*} else {
          echo $notLoggedInErr;
          http_response_code(401);
        }*/
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
      //if (Login::isLoggedIn()) {
      if (isset($_GET['token'])) {
          $token = $_GET['token'];
          $userid = $userDAO->getLoggedInUserId(sha1($token));
          $currentUser = $userDAO->getUserById($userid);
          echo json_encode($currentUser);
      } else {
          echo $notFoundErr;
          http_response_code(405);
      }
      /*} else {
        echo $notLoggedInErr;
        http_response_code(401);
      }*/
  } else if ($_GET['url'] == 'studentEvaluations'){
      if (isset($_GET['student']) && isset($_GET['module'])) {
          $studentId = $_GET['student'];
          $moduleId = $_GET['module'];
          $evaluaties = $userDAO->getEvaluaties($studentId, $moduleId);

          $evaluations = [];

          foreach($evaluaties as $evaluatie){
              array_push($evaluations, $evaluatie);
          }
          echo json_encode($evaluations);
      } else {
          echo $notFoundErr;
          http_response_code(405);
      }
  } else if ($_GET['url'] == 'studentEvaluation') {
      //if (Login::isLoggedIn()) {
      if (isset($_GET['id'])) {
          $evaluatieId = $_GET['id'];

          $evaluatie = $userDAO->getEvaluatie($evaluatieId);
          $module = $userDAO->getModule($evaluatie->moduleId);

          $evaluation = (object)[
              'id' => $evaluatie->id,
              'naam' => $evaluatie->name,
              'module' => $module->name,
              'doelstellingscategories' => array()
          ];

          $doelstellingscategories = $userDAO->getDoelstellingscategoriesInModule($module->id);

          foreach($doelstellingscategories as $doelstellingscategorie){

              $doelstellingscategorieObjToPush = (object)[
                  'id' => $doelstellingscategorie->id,
                  'name' => $doelstellingscategorie->name,
                  'doelstellingen' => array()
              ];

              $doelstellingen = $userDAO->getDoelstellingenInDoelstellingscategorie($doelstellingscategorie->id);

              foreach($doelstellingen as $doelstelling) {

                  $doelstellingObjToPush = (object)[
                      'id' => $doelstelling->id,
                      'name' => $doelstelling->name,
                      'evaluatiecriteria' => array()
                  ];

                  $evaluatiecriteria = $userDAO->getCriteriaInDoelstelling($doelstelling->id);

                  foreach($evaluatiecriteria as $criterium) {

                      $evaluatiecriteriumObjToPush = (object)[
                          'id' => $criterium->id,
                          'name' => $criterium->name,
                          'beoordelingsaspecten' => array()
                      ];

                      $beoordelingsaspecten = $userDAO->getBeoordelingsaspectenInEvaluatiecriterium($criterium->id);

                      foreach($beoordelingsaspecten as $aspect){

                          $ratingObj = $userDAO->getAspectbeoordeling($evaluatie->id, $aspect->id);
                          $score = null;
                          if($ratingObj != null) {
                              $score = $ratingObj->aspectBeoordeling;
                          }

                          $beoordelingsAspectObjToPush = (object)[
                              'id' => $aspect->id,
                              'name' => $aspect->name,
                              'score' => $score
                          ];

                          array_push($evaluatiecriteriumObjToPush->beoordelingsaspecten, $beoordelingsAspectObjToPush);
                      }

                      array_push($doelstellingObjToPush->evaluatiecriteria, $evaluatiecriteriumObjToPush);
                  }

                  array_push($doelstellingscategorieObjToPush->doelstellingen, $doelstellingObjToPush);
              }

              array_push($evaluation->doelstellingscategories, $doelstellingscategorieObjToPush);
          }

          echo json_encode($evaluation);

          http_response_code(200);
      } else {
          echo $notFoundErr;
          http_response_code(405);
      }
      /*} else {
        echo $notLoggedInErr;
        http_response_code(401);
      }*/
  } else if ($_GET['url'] == 'studentReports'){
      if (isset($_GET['id'])) {
          $studentId = $_GET['id'];
          $rapporten = $userDAO->getRapporten($studentId);

          $reports = [];

          foreach($rapporten as $rapport){
              array_push($reports, $rapport);
          }
          echo json_encode($reports);
      } else {
          echo $notFoundErr;
          http_response_code(405);
      }
  } else if ($_GET['url'] == 'studentReport') {
    //if (Login::isLoggedIn()) {
      if (isset($_GET['id'])) {
        $rapportid = $_GET['id'];

          $rapport = $userDAO->getRapport($rapportid);
          $modules = $userDAO->getRapportmodules($rapport->id);

          $report = (object)[
              'id' => $rapport->id,
              'name' => $rapport->name,
              'klas' => $rapport->class,
              'modules' => array(),
              'commentaarAlgemeen' => $rapport->commentaarAlgemeen,
              'commentaarKlassenraad' => $rapport->commentaarKlassenraad
          ];

          foreach($modules as $rapportmodule){
              $module = $userDAO->getModule($rapportmodule->moduleId);

              $moduleObjToPush = (object)[
                  'id' => $module->id,
                  'naam' => $module->name,
                  'doelstellingscategories' => array(),
                  'commentaar' => $rapportmodule->commentaar
              ];

              $doelstellingscategories = $userDAO->getDoelstellingscategoriesInModule($module->id);

              foreach($doelstellingscategories as $doelstellingscategorie){

                  $doelstellingscategorieObjToPush = (object)[
                      'id' => $doelstellingscategorie->id,
                      'name' => $doelstellingscategorie->name,
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
                          'name' => $doelstelling->name,
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
      /*} else {
        echo $notLoggedInErr;
        http_response_code(401);
      }*/
    } else if ($_GET['url'] == 'student') {
        //if (Login::isLoggedIn()) {
        if (isset($_GET['id'])) {
            $userid = $_GET['id'];
            $obj = (object)[
                'student' => $userDAO->getUserById($userid),
                'opleiding' => $userDAO->getEducationFromStudent($userid)
            ];
            echo json_encode($obj);
        } else {
            echo $notFoundErr;
            http_response_code(405);
        }
        /*} else {
          echo $notLoggedInErr;
          http_response_code(401);
        }*/
    } else if ($_GET['url'] == 'opleidingen') {
        //if (Login::isLoggedIn()) {
        $edus = $userDAO->getAllEducations();
        echo json_encode($edus);
        http_response_code(200);
        /*} else {
          echo $notLoggedInErr;
          http_response_code(401);
        }*/
    } else if ($_GET['url'] == 'fullOpleiding') {
        if (isset($_GET['opleiding'])) {
            $opleidingid = $_GET['opleiding'];

            $opleiding = (object)[
                'modules' => array()
            ];

            $modules = $userDAO->getModulesInOpleiding($opleidingid);
            foreach ($modules as $module) {

                $modObj = (object)[
                    'id' => $module->id,
                    'name' => $module->name,
                    'categorieen' => array()
                ];

                $categorieen = $userDAO->getDoelstellingscategoriesInModule($module->id);
                foreach ($categorieen as $categorie) {
                    $catObj = (object)[
                        'id' => $categorie->id,
                        'name' => $categorie->name,
                        'doelstellingen' => array()
                    ];

                    $doelstellingen = $userDAO->getDoelstellingenInDoelstellingscategorie($categorie->id);

                    foreach($doelstellingen as $doelstelling) {
                        $doelObj = (object)[
                            'id' => $doelstelling->id,
                            'name' => $doelstelling->name
                        ];

                        array_push($catObj->doelstellingen, $doelObj);
                    }
                    array_push($modObj->categorieen, $catObj);
                }
                array_push($opleiding->modules, $modObj);
            }
            echo json_encode($opleiding);
            http_response_code(200);
        } else {
            echo '{"Status":"Opleiding niet gevonden"}';
            http_response_code(403);
        }
    } else if ($_GET['url'] == 'modulesVoorOpleiding') {
        //if (Login::isLoggedIn()) {
        if (isset($_GET['opleiding'])) {
            $opleidingid = $_GET['opleiding'];
            $modules = $userDAO->getModulesInOpleiding($opleidingid);
            echo json_encode($modules);
            http_response_code(200);
        }
        /*} else {
          echo $notLoggedInErr;
          http_response_code(401);
        }*/
    } else if ($_GET['url'] == 'categorieenInModules') {
        //if (Login::isLoggedIn()) {
        if (isset($_GET['module'])) {
            $modid = $_GET['module'];
            $categorieen = $userDAO->getDoelstellingscategoriesInModule($modid);
            echo json_encode($categorieen);
            http_response_code(200);
        }
        /*} else {
          echo $notLoggedInErr;
          http_response_code(401);
        }*/
    } else if ($_GET['url'] == 'doelstellingenInCategorie') {
        //if (Login::isLoggedIn()) {
        if (isset($_GET['categorie'])) {
            $categorieId = $_GET['categorie'];
            $doelstellingen = $userDAO->getDoelstellingenInDoelstellingscategorie($categorieId);
            echo json_encode($doelstellingen);
            http_response_code(200);
        }
        /*} else {
          echo $notLoggedInErr;
          http_response_code(401);
        }*/
    } else if ($_GET['url'] == 'criteriaInDoelstelling') {
        //if (Login::isLoggedIn()) {
        if (isset($_GET['doelstelling'])) {
            $doelid = $_GET['doelstelling'];
            $criteria = $userDAO->getCriteriaInDoelstelling($doelid);
            echo json_encode($criteria);
            http_response_code(200);
        }
        /*} else {
          echo $notLoggedInErr;
          http_response_code(401);
        }*/
    } else if ($_GET['url'] == 'studentenMetOpleiding') {
        $obj = $userDAO->getAllActiveStudentsWithEducation();
        echo json_encode($obj);
        http_response_code(200);
    } else if ($_GET['url'] == 'evalFicheVoorLeerkracht') {
        if (isset($_GET['leerkracht'])) {
            $teachId = $_GET['leerkracht'];
        }
        http_response_code(200);
    } else if ($_GET['url'] == 'evaluatieVoorStudent') {
        if (isset($_GET['id'])) {
            $studentid = $_GET['id'];
            $evalForStudent = (object)[
                'modules' => array()
            ];
            $modsOfStudent = $userDAO->getModulesFromStudent($studentid);
            foreach ($modsOfStudent as $module) {
                $modObj = (object)[
                    'id' => $module->id,
                    'name' => $module->name,
                    'categorieen' => array()
                ];

                $categorieen = $userDAO->getDoelstellingscategoriesInModule($module->id);
                foreach ($categorieen as $categorie) {
                    $catObj = (object)[
                        'id' => $categorie->id,
                        'name' => $categorie->name,
                        'doelstellingen' => array()
                    ];

                    $doelstellingen = $userDAO->getDoelstellingenInDoelstellingscategorie($categorie->id);

                    foreach($doelstellingen as $doelstelling) {
                        $doelObj = (object)[
                            'id' => $doelstelling->id,
                            'name' => $doelstelling->name,
                            'criteria' => array()
                        ];

                        $criteria = $userDAO->getCriteriaInDoelstelling($doelstelling->id);
                        foreach($criteria as $criterium) {
                            $critObj = (object)[
                                'id' => $criterium->id,
                                'name' => $criterium->name,
                                'aspecten' => array()
                            ];

                            $aspecten = $userDAO->getBeoordelingsaspectenInEvaluatiecriterium($criterium->id);
                            foreach($aspecten as $aspect) {
                                $aspectObj = (object)[
                                    'id' => $aspect->id,
                                    'name' => $aspect->name,
                                ];

                                array_push($critObj->aspecten, $aspectObj);
                            }
                            array_push($doelObj->criteria, $critObj);
                        }
                        array_push($catObj->doelstellingen, $doelObj);
                    }
                    array_push($modObj->categorieen, $catObj);
                }
                array_push($evalForStudent->modules, $modObj);
            }
            echo json_encode($evalForStudent);
            http_response_code(200);
        } else {
            echo '{"Error":"No studentid found"}';
            http_response_code(403);
        }
    } else if ($_GET['url'] == 'getEvaluatieByName') {
      if (isset($_GET['name'])) {
        $id = $userDAO->getEvaluatieId($_GET['name']);
        $evaluatie = $userDAO->getEvaluatie($id);
        echo json_encode($evaluatie);
        http_response_code(200);
      } else {
        echo '{"Status":"No correct evaluatie name given"}';
        http_response_code(403);
      }
    } else if ($_GET['url'] == 'getEvaluatie') {
      if (isset($_GET['id'])) {
        $evaluatie = $userDAO->getEvaluatie($_GET['id']);
        echo json_encode($evaluatie);
        http_response_code(200);
      } else {
        echo '{"Status": "No correct eval id given"}';
        http_response_code(403);
      }
    } else if ($_GET['url'] == 'getEvaluatiesPerStudent') {
      if (isset($_GET['modId']) && isset($_GET['studId'])) {
        $evaluaties = (object)[
          'evaluaties' => array()
        ];
        $evaluatiesPerStudent = $userDAO->getEvaluaties($_GET['studId'], $_GET['modId']);
        foreach ($evaluatiesPerStudent as $eval) {
          $evalObj = (object)[
            'id' => $eval->id,
            'name' => $eval->name,
            'date' => preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3/$2/$1', $eval->datum),
            'aspecten' => $userDAO->getAspectbeoordelingen($eval->id)
          ];
          array_push($evaluaties->evaluaties, $evalObj);
        }

        echo json_encode($evaluaties);
        http_response_code(200);
      } else {
        echo '{"Error":"Wrong student or module id(s)"}';
        http_response_code(403);
      }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['url'] == 'auth') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        $username = $postBody->username;
        $password = $postBody->password;

        $user = $userDAO->getUserPw($username);
        if (!empty($user)) {
            // $password_hash = $userDAO->getUserPw($username)->password;
            $hashedPW = $user->password;
          if (password_verify($password, $hashedPW)) {//$password == $userDAO->getUserPw($username)->password) {// TODO hash PW!
                $cstrong = True;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                $user_id = $userDAO->getUser($username)->id;
                $userDAO->insertNewLoginToken($user_id, sha1($token));
                setcookie("GID", $token, time() + 60 * 60 * 24 * 7, '/'/*, NULL, NULL, false*/);
                //setcookie("GID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                $cookieObj = (object)[
                    'GID' => $token,
                    'GID_' => '1'
                ];
                echo json_encode($cookieObj);
                http_response_code(200);
            } else {
                echo '{"Error":"Wrong pw"}';
                http_response_code(401);
            }
        } else {
            echo '{"Error":"Wrong username"}';
            http_response_code(401);
        }
    } else if ($_GET['url'] == 'updateUser') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        $firstname = $postBody->firstname;
        $lastname = $postBody->lastname;
        $email = $postBody->email;

        //$id = Login::isLoggedIn();
        if (Login::isLoggedIn()) {
            //$userDAO->updateUser($firstname, $lastname, $email , $id);
            echo '{"Status":"User updated"}';
            http_response_code(200);
        } else {
            echo $notLoggedInErr;
            http_response_code(401);
        }
    } else if ($_GET['url'] == 'createModule') {

    } else if ($_GET['url'] == 'createOpleiding') {
      $postBody = file_get_contents('php://input');
      $postBody = json_decode($postBody);

      $creatorid =   $postBody->creatorid;
      $name =   $postBody->name;

      if (empty($creatorid) || empty($name)) {
        echo '{"Error":"Opleiding not created"}';
        http_response_code(403);
      } else {
        $userDAO->createEducation($name, $creatorId);
        echo 'Opleiding created';
        http_response_code(200);
      }
    } else if ($_GET['url'] == 'evaluateCrit') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        $critToEval = $postBody->critToEval;
        $score = $postBody->score;

        if (Login::isLoggedIn()) {
            // check if teacher
            // $userDAO->evaluateCrit($critToEval,$score);
            echo '{"Status":"Succesfull evaluated"}';
            http_response_code(200);
        } else {
            echo $notLoggedInErr;
            http_response_code(401);
        }
    } else if ($_GET['url'] == 'updatePw') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        $userid = $postBody->userid;
        $newpw = $postBody->pw;

        if ($userid == $userDAO->getUserById($userid)->id) {
            $password_hash = password_hash($newpw, PASSWORD_BCRYPT);
            $userDAO->updatePassword($userid, $password_hash);
            echo '{"Status":"pw updated"}';
            http_response_code(200);
        } else {
            echo '{"Error":"Not updated"}';
            http_response_code(403);
        }
    } else if ($_GET['url'] == 'resetPassword') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        $username = $postBody->username;
        $password = $postBody->password;
        $confirmedPw = $postBody->confirm;

        $user = $userDAO->getUser($username);

        if ($user->username != null) {
            if ($password == $confirmedPw) {
                $userDAO->updatePassword($user->id, $confirmedPw);
                echo '{"Success":"Paswoord is gereset"}';
                http_response_code(200);
            } else {
                echo '{"Error":"Passwords do not match"}';
                http_response_code(403);
            }
        } else {
            echo '{"Error":"Gebruiker bestaat niet"}';
            http_response_code(403);
        }

    } else if ($_GET['url'] == 'saveEvaluatie') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        $date = $postBody->date;
        $date = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$2-$1', $date);
        $aspecten = $postBody->aspecten;

        $beoordeeldeAspecten = [];

        foreach($aspecten as $aspect){
          $beoordeeldeAspecten[$aspect->aspectId] = $aspect->beoordeling;
        }

        $userDAO->insertNewEvaluation($postBody->name,$postBody->studentId,$postBody->moduleId,$date);
        $evaluatieId = $userDAO->getEvaluatieId($postBody->name);
        $userDAO->insertAspectbeoordelingen($evaluatieId, $beoordeeldeAspecten);

        /*foreach ($aspecten as $aspect) {
          $aspectid = $aspect->id;
          $quotering = $aspect->eval;
          $userDAO->saveAspecten($aspectid,$quotering);
        }*/
    } else if ($_GET['url'] == 'createStudent') {
      /*$postBody = file_get_contents('php://input');
      $postBody = json_decode($postBody);

      $firstname = $postBody->firstname;
      $lastname = $postBody->lastname;
      $email = $postBody->email;
      // TODO $pw = generate a password + email it;
      $moduleIds = $postBody->moduleIds;
      $creatorId = $postBody->id;

      $password_hash = password_hash($pw, PASSWORD_BCRYPT);

      if ($firstname != "" || $lastname != "" || $pw != "") {
        echo '{"Error":"Student not created"}';
        http_response_code(403);
      } else {
        $studentid = $userDAO->getUser($email)->id;
        $userDAO->createUser($firstname,$lastname,$email,$password_hash,$creatorId);
        $userDAO->makeUserStudent($studentid);
        $userDAO->addStudentToModules($studentid, $moduleIds);
        echo 'Student created';
        http_response_code(200);
      }*/
  } else if ($_GET['url'] == 'updateStudent') {
    /*$postBody = file_get_contents('php://input');
    $postBody = json_decode($postBody);

    $firstname = $postBody->firstname;
    $lastname = $postBody->lastname;
    $email = $postBody->email;
    $moduleIds = $postBody->moduleIds;
    $creatorId = $postBody->id;

    $userDAO->updateStudent();
*/
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    if ($_GET['url'] == 'updateEvaluatie') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);
        var_dump($postBody);

        if (!empty($postBody)) {
            $evalId = $postBody->evalId;
            $date = $postBody->date;
            $date = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$2-$1', $date);
            $aspecten = $postBody->aspecten;

            $beoordeeldeAspecten = [];

            foreach($aspecten as $aspect){
                $beoordeeldeAspecten[$aspect->aspectId] = $aspect->beoordeling;
            }
            $userDAO->updateEvaluatie($evalId, $postBody->name,$date, $beoordeeldeAspecten);
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
                echo '{ "Error": "Invalid token" }';
                http_response_code(400);
            }
        } else {
            echo '{ "Error": "Malformed request" }';
            http_response_code(400);
        }
    } else if ($_GET['url'] == 'deleteEvaluatie') {
        if (isset($_GET['id'])) {
            echo '{"Status": "deleting evaluation '.$_GET['id'].'"}';
            $userDAO->deleteEvaluatie($_GET['id']);
            http_response_code(200);
        } else {
            echo '{"Status": "No correct evaluation id given"}';
            http_response_code(403);
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    echo '{"Status":"options allowed"}';
    http_response_code(200);
} else {
    http_response_code(405);
}
