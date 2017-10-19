<?php

require_once('config.php');

class graderdb {

  public static function getConnection() {

        // Construct the PDO adress line
        $host = Config::$dbServer;
        $port = Config::$dbPort;
        $database = Config::$dbName;
        $dsn = "mysql:host=$host;port=$port;dbname=$database";

        // Try to connect to the database
        $conn = new PDO($dsn, Config::$dbUser, Config::$dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

}

class UserDAO {

  public static function getAllUsers(){
    try {
      $conn = graderdb::getConnection();

      $sql = 'SELECT email FROM users';
      $stmt = $conn->prepare($sql);

      $stmt->execute();

      $usersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    if(isset($usersTable[0])) {
      $users = $usersTable;
    } else {
      die('No users found!');
    }

    return $users;
  }

  public static function getUser($username) {
    try {
      $conn = graderdb::getConnection();

      $sql = 'SELECT * FROM users WHERE email = :username';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':username', $username);
      $stmt->execute();

      $usersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    if(isset($usersTable[0])) {
      $user = $usersTable[0];
    } else {
      die('No user with username = ' . $username);
    }

    return $user;
  }

  public static function createUser($firstname, $lastname, $email, $password) {
    try {
      $conn = graderdb::getConnection();

      $sql = 'INSERT INTO users VALUES(:firstname, :lastname, :email, :password)';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':firstname',$firstname);
      $stmt->bindParam(':lastname',$lastname);
      $stmt->bindParam(':email',$email);
      $stmt->bindParam(':password',$password);
      $stmt->execute();

    } catch (PDOException $e) {
      die($e->getMessage());
    }

  }

  public static function searchStudents($query) {
    try {
      $conn = graderdb::getConnection();

      $sql = 'SELECT firstname, lastname FROM users WHERE firstname LIKE :query OR lastname LIKE :query';

      $stmt = $conn->prepare($sql);
      $query = '%'.$query.'%';
      $stmt->bindParam(':query',$query,PDO::PARAM_STR);
      $stmt->execute();

      $studentsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
    } catch (PDOException $e) {
      die($e->getMessage());
    }

      if(isset($studentsTable[0])) {
        $students = $studentsTable;
      } else {
        die('no students found');
      }

      return $students;
  }

  /*public static function searchEducations() {
    return;
  }*/

    public static function getAllStudents(){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM users WHERE id IN (SELECT studentId FROM studenten)';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $studentsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($studentsTable[0])) {
            $students = $studentsTable;
        } else {
            die('No users found!');
        }

        return $students;
    }

    public static function getAllStudentsInEducation($educationId){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT DISTINCT u.* FROM users u
	                  JOIN studenten s on u.id = s.studentId
	                  JOIN studenten_modules_opleidingen smo ON s.studentId = smo.studentId
	                  JOIN opleidingen o ON o.id = smo.opleidingId
                      WHERE o.id = :educationId';

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':educationId',$educationId);

            $stmt->execute();

            $studentsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($studentsTable[0])) {
            $students = $studentsTable;
        } else {
            die('No students found!');
        }

        return $students;
    }



    public static function getAllEducations(){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM opleidingen';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $educationsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($educationsTable[0])) {
            $educations = $educationsTable;
        } else {
            die('No educations found!');
        }

        return $educations;
    }

    public static function getAllMessages(){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM meldingen ORDER BY id DESC';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $messagesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($messagesTable[0])) {
            $messages = $messagesTable;
        } else {

            die('No messages found!');
        }

        return $messages;
    }

    public static function getTeacherById($teacherId){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM users u JOIN teachers t ON u.id = t.teacherId WHERE teacherId = :teacherId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':teacherId',$teacherId);

            $stmt->execute();

            $teachersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($teachersTable[0])) {
            $teacher = $teachersTable[0];
        } else {
            die('No teacher found with id = ' . $teacherId);
        }

        return $teacher;
    }

}
