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
            die('No user with username = ' . $username);
        }

        return $user;
    }

    public static function searchStudents($query) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM users WHERE firstname LIKE :query OR lastname LIKE :query';

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
	                  JOIN studenten_modules sm ON s.studentId = sm.studentId
	                  JOIN modules m ON sm.moduleId = m.id
                      JOIN werkfiches w ON m.werkficheId = w.id
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

    public static function getWerkfichesFromStudent($studentId){
        try{
            $conn = graderdb::getConnection();

            $sql = 'SELECT DISTINCT w.* FROM users u JOIN studenten s ON u.id = s.studentId
                      JOIN studenten_modules sm ON s.studentId = sm.studentId
                      JOIN modules m ON m.id = sm.moduleId
                      JOIN werkfiches w ON m.werkficheId = w.id
                      -- JOIN opleidingen o ON sm.opleidingId = o.id -- geeft de algemene werkfiches, niet specifiek aan de opleiding
                      -- JOIN opleidingen o ON w.opleidingId = o.id -- geeft de opleidingsspecifieke werkfiches
                      WHERE sm.status = \'volgt\'
	                    AND s.studentId = :studentId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId',$studentId);

            $stmt->execute();

            $werkficheTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($werkficheTable[0])) {
            $werkfiches = $werkficheTable;
        } else {
            die('No werkfiches found for student with id = ' . $studentId);
        }
        return $werkfiches;
    }

    public static function getFollowedModulesInFiche($werkficheId, $studentId){
        try{
            $conn = graderdb::getConnection();

            $sql = 'SELECT m.* FROM studenten_modules sm
                      JOIN modules m ON sm.moduleId = m.id
                      JOIN werkfiches w on m.werkficheId = w.id
                      WHERE studentId = :studentId AND werkficheId = :werkficheId
                        AND status=\'volgt\'';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId',$studentId);
            $stmt->bindParam(':werkficheId',$werkficheId);

            $stmt->execute();

            $werkficheTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($werkficheTable[0])) {
            $modules = $werkficheTable;
        } else {
            die('No modules found for student with id = ' . $studentId . ' in werkfiche with id ' . $werkficheId);
        }

        return $modules;
    }

    public static function getCriteriaForModule($moduleId){
        try{
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from evaluatiecriteria
                    WHERE moduleId = :moduleId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':moduleId',$moduleId);

            $stmt->execute();

            $criteriaTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if(isset($criteriaTable[0])) {
            $criteria = $criteriaTable;
        } else {
            die('No criteria found for module with id = ' . $moduleId);
        }

        return $criteria;
    }

     //////////////////////////////////////////////
    //              SELECT-QUERIES              //
   //////////////////////////////////////////////

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

    public static function createWerkfiche($name, $opleidingId, $creatorId) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO werkfiches(name, opleidingId, creatorId) VALUES(:name, :opleidingId, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':opleidingId', $opleidingId);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function createModule($name, $opleidingId, $creatorId) {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO werkfiches(name, opleidingId, creatorId) VALUES(:name, :opleidingId, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':opleidingId', $opleidingId);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
