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

  public static function getUserByEmail($email) {
    try {
      $conn = graderdb::getConnection();

      $sql = 'SELECT * FROM users WHERE email = :email';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':email', $email);
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

  public static function getUserAndPassword($username) {
    try {
      $conn = graderdb::getConnection();

      $sql = 'SELECT email, password FROM users WHERE email = :username';
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

    public static function getAllStudentsInEducation($educationName){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT DISTINCT u.* FROM users u
	                  JOIN studenten s on u.id = s.studentId
	                  JOIN studenten_modules sm ON s.studentId = sm.studentId
	                  JOIN opleidingen_modules om ON om.moduleId = sm.moduleId
	                  JOIN opleidingen o ON o.id = om.opleidingId
                      WHERE o.name = :educationName';

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':educationName',$educationName);

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
}
