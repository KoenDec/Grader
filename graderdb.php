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

     ///////////////////////////////////////////
    //              GET-QUERIES              //
   ///////////////////////////////////////////

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
            //die('No user with username = ' . $username);
            $user = null;
        }

        return $user;
    }

    public static function getUserRole($userId){
        try {
            $conn = graderdb::getConnection();

            $sql1 = 'SELECT * FROM teachers WHERE teacherId = :userid';
            $sql2 = 'SELECT * FROM admins WHERE adminId = :userid';
            $sql3 = 'SELECT * FROM studenten WHERE studentId = :userid';

            $stmt1 = $conn->prepare($sql1);
            $stmt1->bindParam(':userid', $userId);
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(':userid', $userId);
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bindParam(':userid', $userId);

            $stmt1->execute();
            $stmt2->execute();
            $stmt3->execute();

            $teachersTable = $stmt1->fetchAll(PDO::FETCH_CLASS);
            $studentsTable = $stmt3->fetchAll(PDO::FETCH_CLASS);
            $adminsTable = $stmt2->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($studentsTable[0])) {
            return "STUDENT";
        } else if(isset($teachersTable[0])){
            return "LEERKRACHT";
        } else if(isset($adminsTable[0])){
            return "ADMIN";
        } else {
            die("user does not have a role yet");
        }
    }



    public static function getUserById($userid) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM users WHERE id = :userid';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userid', $userid);
            $stmt->execute();

            $usersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($usersTable[0])) {
            $user = $usersTable[0];
        } else {
            //die('No user with username = ' . $userid);

        }

        return $user;
    }

    public static function getLoggedInUserId($token) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT userId FROM loginTokens WHERE token = :token';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $usersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($usersTable[0])) {
            $userid = $usersTable[0];
        } /*else {
            die('No userid found');
        }*/

        return $userid;
    }

    public static function getToken($token) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT token FROM loginTokens WHERE token = :token';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $tokenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($tokenTable[0])) {
            $token = $tokenTable[0];
        } /*else {
            die('No userid found');
        }*/

        return $token;
    }

    public static function searchStudents($query) {
        try {
            $conn = graderdb::getConnection();

            $sql = '    SELECT * FROM users WHERE ((firstname LIKE :query)
								                    OR (lastname LIKE :query)
								                    OR CONCAT(firstname, " ", lastname) LIKE :query
								                    OR CONCAT(lastname, " ", firstname) LIKE :query
							                  ) AND (id IN (SELECT studentId FROM studenten))';

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
	                  JOIN studenten_doelstellingen sm ON s.studentId = sm.studentId
	                  JOIN doelstellingen m ON sm.doelstellingId = m.id
                      JOIN modules w ON m.moduleId = w.id
                      WHERE sm.status = \'volgt\'
			            AND w.opleidingId = :educationId OR sm.opleidingId = :educationId';

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
            //die('No students found!');
            $students = null;
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
            //die('No educations found!');
            $educations = null;
        }

        return $educations;
    }

    public static function getEducation($educationId){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM opleidingen WHERE id = :educationId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':educationId',$educationId);

            $stmt->execute();

            $educationsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($educationsTable[0])) {
            $education = $educationsTable[0];
        } else {
            //die('No education found with id '.$educationId);
            $education = null;
        }

        return $education;
    }

    public static function getEducationByName($educationName){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM opleidingen WHERE name = :educationName';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':educationName',$educationName);

            $stmt->execute();

            $educationsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($educationsTable[0])) {
            $education = $educationsTable[0];
        } else {
            //die('No education found with id '.$educationId);
            $education = null;
        }

        return $education;
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

    public static function getAllTeachers(){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM users WHERE id IN (SELECT teacherId FROM teachers)';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $teachersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($teachersTable[0])) {
            $teachers = $teachersTable;
        } else {
            die('No teachers found!');
        }

        return $teachers;
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

    public static function getModulesInOpleiding($opleidingId){
        try {
            $conn = graderdb::getConnection();

            if($opleidingId == null) $sql = 'SELECT * FROM modules WHERE opleidingId is null';
            else $sql = 'SELECT * FROM modules WHERE opleidingId = :opleidingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':opleidingId',$opleidingId);

            $stmt->execute();

            $modulesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($modulesTable[0])) {
            $modules = $modulesTable;
        } else {
            //die('No modules found!');
            $modules = null;
        }

        return $modules;
    }

    public static function getModulesFromStudent($studentId){
        try{
            $conn = graderdb::getConnection();

            $sql = 'SELECT DISTINCT w.* FROM users u JOIN studenten s ON u.id = s.studentId
                      JOIN studenten_doelstellingen sm ON s.studentId = sm.studentId
                      JOIN doelstellingen m ON m.id = sm.doelstellingId
                      JOIN modules w ON m.moduleId = w.id
                      -- JOIN opleidingen o ON sm.opleidingId = o.id -- geeft de algemene modules, niet specifiek aan de opleiding
                      -- JOIN opleidingen o ON w.opleidingId = o.id -- geeft de opleidingsspecifieke modules
                      WHERE sm.status = \'volgt\'
	                    AND s.studentId = :studentId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId',$studentId);

            $stmt->execute();

            $moduleTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($moduleTable[0])) {
            $modules = $moduleTable;
        } else {
            die('No modules found for student with id = ' . $studentId);
        }
        return $modules;
    }

    public static function getDoelstellingenInModule($moduleId){
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM doelstellingen WHERE moduleId = :moduleId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':moduleId',$moduleId);

            $stmt->execute();

            $doelstellingenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($doelstellingenTable[0])) {
            $doelstellingen = $doelstellingenTable;
        } else {
            //die('No doelstellingen found!');
            $doelstellingen = null;
        }

        return $doelstellingen;
    }

    public static function getFollowedDoelstellingenInModule($moduleId, $studentId){
        try{
            $conn = graderdb::getConnection();

            $sql = 'SELECT m.* FROM studenten_doelstellingen sm
                      JOIN doelstellingen m ON sm.doelstellingId = m.id
                      JOIN modules w on m.moduleId = w.id
                      WHERE studentId = :studentId AND moduleId = :moduleId
                        AND status=\'volgt\'';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId',$studentId);
            $stmt->bindParam(':moduleId',$moduleId);

            $stmt->execute();

            $moduleTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($moduleTable[0])) {
            $doelstellingen = $moduleTable;
        } else {
            die('No doelstellingen found for student with id = ' . $studentId . ' in module with id ' . $moduleId);
        }

        return $doelstellingen;
    }

    public static function getCriteriaForDoelstelling($doelstellingId){
        try{
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from evaluatiecriteria
                    WHERE doelstellingId = :doelstellingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':doelstellingId',$doelstellingId);

            $stmt->execute();

            $criteriaTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($criteriaTable[0])) {
            $criteria = $criteriaTable;
        } else {
            //die('No criteria found for doelstelling with id = ' . $doelstellingId);
            $criteria = null;
        }

        return $criteria;
    }

     //////////////////////////////////////////////
    //              INSERT-QUERIES              //
   //////////////////////////////////////////////

    public static function createUser($firstname, $lastname, $email, $password, $creatorId) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO users(firstname,lastname,email,password,creatorId) VALUES(:firstname, :lastname, :email, :password, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':firstname',$firstname);
            $stmt->bindParam(':lastname',$lastname);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':password',$password);
            $stmt->bindParam(':creatorId',$creatorId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function makeUserStudent($userId){
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO studenten(studentId) VALUES(:userId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userId',$userId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function createEducation($name, $creatorId) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO opleidingen(name, creatorId) VALUES(:name, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function createModule($name, $opleidingId, $creatorId) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO modules(name, opleidingId, creatorId) VALUES(:name, :opleidingId, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':opleidingId', $opleidingId);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function createDoelstellingen($name, $opleidingId, $creatorId) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO modules(name, opleidingId, creatorId) VALUES(:name, :opleidingId, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':opleidingId', $opleidingId);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function insertNewLoginToken($userid, $token) {
      try {
        $conn = graderdb::getConnection();

        $sql = 'INSERT INTO loginTokens(token, userId) VALUES(:token, :userid)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':userid', $userid);

        $stmt->execute();
      } catch (PDOException $e) {
        die($e->getMessage());
      }

    }

    //////////////////////////////////////////////
    //              UPDATE-QUERIES              //
    //////////////////////////////////////////////

    public static function updateUser($firstName, $lastName, $email, $userId) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE users SET firstname=:firstName, lastname=:lastName, email=:email WHERE id = :userId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //////////////////////////////////////////////
    //              DELETE-QUERIES              //
    //////////////////////////////////////////////

  public static function removeLoginToken($token) {
    try {
      $conn = graderdb::getConnection();

      $sql = 'DELETE FROM loginTokens WHERE token=:token';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':token', $token);

      $stmt->execute();

    } catch (PDOException $e) {
      die($e->getMessage());
    }

  }

  public static function removeAllTokensFromUser($userid) {
    try {
      $conn = graderdb::getConnection();

      $sql = 'DELETE FROM loginTokens WHERE userId=:userid';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':userid', $userid);

      $stmt->execute();
    } catch (PDOException $e) {
      die($e->getMessage());
    }

  }
}
