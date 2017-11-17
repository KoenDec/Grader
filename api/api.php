<?php
require_once('../php/graderdb.php');

class ApiController
{

  private $userDAO = new UserDAO();

  public static function isStudent($userid) {
    $isStudent = false;

    $students = $userDAO->getAllStudents();
    foreach ($students as $student) {
      if ($student->id == $userid) {
        $isStudent = true;
      }
    }

    return $isStudent;
  }

  public static function isTeacher($userid) {
    $isTeacher = false;

    $teachers = $userDAO->getAllTeachers();
    foreach ($teachers as $teacher) {
      if ($teacher->id == $userid) {
        $isTeacher = true;
      }
    }

    return $isTeacher;
  }
/*
  public static function createReportObj($studentid) {
    $modules = $userDAO->getModulesFromStudent($studentid);
    foreach($modules as $module) {
      $modArr = array();
      echo $module->name;
      $doelstellingen = $userDAO->getFollowedDoelstellingenInModule($module->id, $studentid);
      foreach ($doelstellingen as $doelstelling) {
        $doelstellingArr = array();
        echo $doelstelling->name;
        $criteria = $userDAO->getCriteriaForDoelstelling($doelstelling->id);
        foreach ($criteria as $criterium) {
          $critArr = array();
          $critObj = new stdObject();
          $critObj->id = $criterium->id;
          $critObj->name = $criterium->weergaveTitel;
          array_push($critArr,$critObj);
        }
        array_push($doelstellingArr, $critArr);
      }
      array_push($modArr, $doelstellingArr);
    }

    return $modarr;
  }*/

}
