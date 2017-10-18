<?php
require_once('graderdb.php');
$studentDAO = new UserDAO();
if(!empty($_POST['keyword'])) {
  $students = $studentDAO->searchStudents($_POST['keyword']);
  echo json_encode($students);
} else {
  echo 'no students';
}
