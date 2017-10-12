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

  public static function getUserAndPassword($username) {
    try {
      $conn = $graderdb::getConnection();

      $sql = 'SELECT username, password FROM users WHERE username = :username';
      $stmt = $con->prepare($sql);
      $stmt->bindParam(':username', $username);
      $stmt->execute();

      $usersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    if(isset(usersTable[0])) {
      $user = $usersTable[0];
    } else {
      die('No user with username = ' . $username);
    }

    return $user;

  }
}
