<?php
require_once('../graderdb.php');

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

}
