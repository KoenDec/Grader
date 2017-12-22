<?php
require_once('graderdb.php');
require_once('Login.php');
require_once('token.php');
//require_once('mailer.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, PATCH, GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin,Content-Type");
header('Content-Type: application/json');

$userDAO = new UserDAO();
$notFoundErr = '{"Error":"Geen user gevonden"}';
$notLoggedInErr = '{"Error":"Niet ingelogd"}';
$notAuthorizedErr = '{"Error":" Onbevoegd"}';

$studentRole = "STUDENT";
$teacherRole = "LEERKRACHT";
$adminRole = "ADMIN";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET['url'] == 'auth') {

    } else if ($_GET['url'] == 'students') {
      //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
        $students = $userDAO->getAllStudents();
        echo json_encode($students);
        http_response_code(200);
      /*} else {
        echo $notLoggedInErr;
        http_response_code(401);
      }*/
    } else if ($_GET['url'] == 'studentInEducation') {
      //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
        if (isset($_GET['edu'])) {
          $edu = $_GET['edu'];
          $studentsInEdu = $userDAO->getAllStudentsInEducation($_GET['edu']);
          echo json_encode($studentsInEdu);
          http_response_code(200);
        } else {
          echo '{"Error":"No edu set"}';
          http_response_code(401);
        }
      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
  } else if ($_GET['url'] == 'currentUser') {
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole) || Token::hasClearance($_GET['token'], $studentRole)) {
      if (isset($_GET['token'])) {
        $userid = Token::getLoggedInUserId($_GET['token']);
        $currentUser = $userDAO->getUserById($userid);
        $userObj = (object)[
          'id' => $userid,
          'name' => $currentUser->firstname . " " . $currentUser->lastname,
          'role' => $userDAO->getUserRole($userid)
        ];
        echo json_encode($userObj);
        http_response_code(200);
      } else {
        echo $notFoundErr;
        http_response_code(405);
      }
    /*} else {
      echo $notAuthorizedErr;
      http_response_code(401);
    }*/
  } else if ($_GET['url'] == 'studentEvaluations'){
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
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
    /*} else {
      echo $notAuthorizedErr;
      http_response_code(401);
    }*/
  } else if ($_GET['url'] == 'studentAllEvaluationsFull'){
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
        if (isset($_GET['student'])) {
            $studentId = $_GET['student'];
            $evaluaties = $userDAO->getAllEvaluaties($studentId);
          if(!empty($evaluaties)){
            $evaluations = [];

            foreach($evaluaties as $evaluatie){
                $evaluation = (object)[
                    'id' => $evaluatie->id,
                    'naam' => $evaluatie->name,
                    'date' => preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3/$2/$1', $evaluatie->datum),
                    'module' => $userDAO->getModule($evaluatie->moduleId)->name,
                    'doelstellingscategories' => array()
                ];

                $doelstellingscategories = $userDAO->getDoelstellingscategoriesInModule($evaluatie->moduleId);

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

                                $beoordelingsAspectObjToPush = (object)[
                                    'id' => $aspect->id,
                                    'name' => $aspect->name,
                                    'score' => $ratingObj->aspectBeoordeling
                                ];

                                array_push($evaluatiecriteriumObjToPush->beoordelingsaspecten, $beoordelingsAspectObjToPush);
                            }

                            array_push($doelstellingObjToPush->evaluatiecriteria, $evaluatiecriteriumObjToPush);
                        }

                        array_push($doelstellingscategorieObjToPush->doelstellingen, $doelstellingObjToPush);
                    }

                    array_push($evaluation->doelstellingscategories, $doelstellingscategorieObjToPush);
                }
                array_push($evaluations, $evaluation);
            }
            echo json_encode($evaluations);

            $http_response_code(200);
          } else {
            echo '{"Error":"Geen evaluaties beschikbaar"}';
            http_response_code(200);
          }
        } else {
            echo $notFoundErr;
            http_response_code(405);
        }
      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
    } else if ($_GET['url'] == 'studentEvaluation') {
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
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
      echo $notAuthorizedErr;
      http_response_code(401);
    }*/
  } else if ($_GET['url'] == 'studentReports'){
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
      if (isset($_GET['id'])) {
          $studentId = $_GET['id'];
          $rapporten = $userDAO->getRapporten($studentId);

          $reports = [];

          usort($rapporten, function($a,$b){
            return strtotime($a->enddate) - strtotime($b->enddate);
          });
          foreach($rapporten as $rapport){
            $rapport->startdate = preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3/$2/$1', $rapport->startdate);
            $rapport->enddate = preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3/$2/$1', $rapport->enddate);
            array_push($reports, $rapport);
          }
          echo json_encode($reports);
      } else {
          echo $notFoundErr;
          http_response_code(405);
      }
    /*} else {
      echo $notAuthorizedErr;
      http_response_code(401);
    }*/
  } else if ($_GET['url'] == 'studentReport') {
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
      if (isset($_GET['id'])) {
        $rapportid = $_GET['id'];

          $rapport = $userDAO->getRapport($rapportid);
          $modules = $userDAO->getRapportmodules($rapport->id);

          $report = (object)[
              'id' => $rapport->id,
              'name' => $rapport->name,
              'klas' => $rapport->class,
              'startdate' => preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3/$2/$1', $rapport->startdate),
              'enddate' => preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3/$2/$1', $rapport->enddate),
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
      echo $notAuthorizedErr;
      http_response_code(401);
    }*/
  } else if ($_GET['url'] == 'student') {
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
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
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
      $edus = $userDAO->getAllEducations();
      echo json_encode($edus);
      http_response_code(200);
    /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
    }*/
  } else if ($_GET['url'] == 'fullOpleiding') {
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
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
      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
  } else if ($_GET['url'] == 'modulesVoorOpleiding') {
        //
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
        //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
        if (isset($_GET['module'])) {
            $modid = $_GET['module'];
            $categorieen = $userDAO->getDoelstellingscategoriesInModule($modid);
            echo json_encode($categorieen);
            http_response_code(200);
        }
        /*} else {
          echo $notAuthorizedErr;
          http_response_code(401);
        }*/
  } else if ($_GET['url'] == 'doelstellingenInCategorie') {
        //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
        if (isset($_GET['categorie'])) {
            $categorieId = $_GET['categorie'];
            $doelstellingen = $userDAO->getDoelstellingenInDoelstellingscategorie($categorieId);
            echo json_encode($doelstellingen);
            http_response_code(200);
        }
        /*} else {
          echo $notAuthorizedErr;
          http_response_code(401);
        }*/
  } else if ($_GET['url'] == 'criteriaInDoelstelling') {
        //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
        if (isset($_GET['doelstelling'])) {
            $doelid = $_GET['doelstelling'];
            $criteria = $userDAO->getCriteriaInDoelstelling($doelid);
            echo json_encode($criteria);
            http_response_code(200);
        }
        /*} else {
          echo $notAuthorizedErr;
          http_response_code(401);
        }*/
  } else if ($_GET['url'] == 'studentenMetOpleiding') {
      //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
        $obj = $userDAO->getAllActiveStudentsWithEducation();
        echo json_encode($obj);
        http_response_code(200);
      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
  } else if ($_GET['url'] == 'evaluatieVoorStudent') {
      //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
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
      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
  } else if ($_GET['url'] == 'getEvaluatieByName') {
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
      if (isset($_GET['name'])) {
        $id = $userDAO->getEvaluatieId($_GET['name']);
        $evaluatie = $userDAO->getEvaluatie($id);
        echo json_encode($evaluatie);
        http_response_code(200);
      } else {
        echo '{"Status":"No correct evaluatie name given"}';
        http_response_code(403);
      }
    /*} else {
      echo $notAuthorizedErr;
      http_response_code(401);
    }*/
  } else if ($_GET['url'] == 'getEvaluatie') {
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
      if (isset($_GET['id'])) {
        $evaluatie = $userDAO->getEvaluatie($_GET['id']);
        echo json_encode($evaluatie);
        http_response_code(200);
      } else {
        echo '{"Status": "No correct eval id given"}';
        http_response_code(403);
      }
    /*} else {
      echo $notAuthorizedErr;
      http_response_code(401);
    }*/
  } else if ($_GET['url'] == 'getEvaluatiesPerStudent') {
    //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
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
    /*} else {
      echo $notAuthorizedErr;
      http_response_code(401);
    }*/
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['url'] == 'auth') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        $username = $postBody->username;
        $password = $postBody->password;

        $user = $userDAO->getUserPw($username);
        if (!empty($user)) {
            $hashedPW = $user->password;
          if (password_verify($password, $hashedPW)) {
            $user_id = $userDAO->getUser($username)->id;
            $clearance = $userDAO->getUserRole($user_id);
            $token = Token::createToken($user_id,$clearance);
            // $userDAO->insertNewLoginToken($user_id, $token);
            echo $token;
            http_response_code(200);
          } else {
            echo '{"Error":"Onjuist paswoord"}';
            http_response_code(401);
          }
        } else {
          echo '{"Error":"Onjuiste email"}';
          http_response_code(401);
        }
    } else if ($_GET['url'] == 'validateToken') {
      $postBody = file_get_contents('php://input');
      $postBody = json_decode($postBody);

      $receivedToken = $postBody->token;

      if (Token::isValid($receivedToken)) {
        echo '{"validation":"true"}';
        http_response_code(200);
      } else {
        echo $notLoggedInErr;
        http_response_code(401);
      }

    } else if ($_GET['url'] == 'createModule') {
        // TODO
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
      $token = $postBody->token;

      //if (Token::hasClearance($token, $teacherRole) || Token::hasClearance($token, $adminRole)) {

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
      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
    } else if ($_GET['url'] == 'resetPassword') {
      $postBody = file_get_contents('php://input');
      $postBody = json_decode($postBody);
      $token = $postBody->token;

      //if (Token::hasClearance($token, $teacherRole) || Token::hasClearance($token, $adminRole)) {

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
      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
    } else if ($_GET['url'] == 'saveEvaluatie') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);
        $token = $postBody->token;

      //if (Token::hasClearance($token, $teacherRole) || Token::hasClearance($token, $adminRole)) {
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

      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
    } else if ($_GET['url'] == 'saveReport') {
        //if (Login::isLoggedIn()) {

        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        if (!empty($postBody)) {

            $punten = [];
            $modules = [];

            foreach($postBody->modules as $module){
                $doelstellingscategories = $module->doelstellingscategories;
                $modules[$module->id] = $module->commentaar;
                foreach($doelstellingscategories as $doelstellingscat){
                    $doelstellingen = $doelstellingscat->doelstellingen;
                    foreach($doelstellingen as $doelstelling){
                        $punten[$doelstelling->id] = array($doelstelling->score,$doelstelling->opmerking);
                    }
                }
            }
            //echo json_encode($punten);

            //echo json_encode($postBody);

            $userDAO->insertNewReport($postBody->name, $postBody->studentId, preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$2-$1', $postBody->startdate), preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$2-$1', $postBody->enddate), $postBody->commentaarKlassenraad, $postBody->commentaarAlgemeen);
            $rapportId = $userDAO->getRapportId($postBody->name);
            $userDAO->insertRapportModules($rapportId,$modules);
            $userDAO->insertRapportscores($rapportId, $punten);

            http_response_code(200);
        } else {
            echo $notFoundErr;
            http_response_code(405);
        }
        /*} else {
          echo $notLoggedInErr;
          http_response_code(401);
        }*/
    } if ($_GET['url'] == 'createStudent') {
      Mailer::mail();
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
        //if (Token::hasClearance($$postBody->token, $teacherRole) || Token::hasClearance($postBody->token, $adminRole)) {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

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
        /*} else {
          echo $notAuthorizedErr;
          http_response_code(401);
        }*/
    } else if ($_GET['url'] == 'updateReport') {
        //if (Token::hasClearance($$postBody->token, $teacherRole) || Token::hasClearance($postBody->token, $adminRole)) {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        if (!empty($postBody)) {
            $reportId = $postBody->reportId;
            $reportName = $postBody->name;
            $startdate = $postBody->startdate;
            $enddate = $postBody->enddate;
            $commentaarAlgemeen = $postBody->commentaarAlgemeen;
            $commentaarKlassenraad = $postBody->commentaarKlassenraad;
            $enddate = $postBody->enddate;
            $startdate = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$2-$1', $startdate);
            $enddate = preg_replace('#(\d{2})/(\d{2})/(\d{4})#', '$3-$2-$1', $enddate);

            $punten = [];
            $modules = [];

            foreach($postBody->modules as $module){
                $doelstellingscategories = $module->doelstellingscategories;
                $modules[$module->id] = $module->commentaar;
                foreach($doelstellingscategories as $doelstellingscat){
                    $doelstellingen = $doelstellingscat->doelstellingen;
                    foreach($doelstellingen as $doelstelling){
                        $punten[$doelstelling->id] = array($doelstelling->score,$doelstelling->opmerking);
                    }
                }
            }

            $userDAO->updateRapport($reportId, $reportName, $startdate, $enddate, $modules, $punten, $commentaarAlgemeen, $commentaarKlassenraad);
            // TODO werkt nog niet
        }
        /*} else {
          echo $notAuthorizedErr;
          http_response_code(401);
        }*/
    } else if ($_GET['url'] == 'updateUser') {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);

        $firstname = $postBody->firstname;
        $lastname = $postBody->lastname;
        $email = $postBody->email;
        $id = $postBody->id;
        $token = $postBody->token;

        if (Token::hasClearance($token, $teacherRole) || Token::hasClearance($token, $adminRole)) {
          $userDAO->updateUser($firstname, $lastname, $email , $id);
          echo '{"Status":"User updated"}';
          http_response_code(200);
        } else {
            echo $notAuthorizedErr;
            http_response_code(401);
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if ($_GET['url'] == 'auth') {
        if (isset($_GET['token'])) {
            if (Token::isValid($_GET['token'])) {
                $userDAO->removeLoginToken($_GET['token']);
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
      //if (Token::hasClearance($_GET['token'], $teacherRole) || Token::hasClearance($_GET['token'], $adminRole)) {
        if (isset($_GET['id'])) {
            echo '{"Status": "deleting evaluation '.$_GET['id'].'"}';
            $userDAO->deleteEvaluatie($_GET['id']);
            http_response_code(200);
        } else {
            echo '{"Status": "No correct evaluation id given"}';
            http_response_code(403);
        }
      /*} else {
        echo $notAuthorizedErr;
        http_response_code(401);
      }*/
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    echo '{"Status":"options allowed"}';
    http_response_code(200);
} else {
    http_response_code(405);
}
