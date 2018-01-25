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

class UserDAO
{

    ///////////////////////////////////////////
    //              GET-QUERIES              //
    ///////////////////////////////////////////

    public static function getAllUsers()
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT email FROM users';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $usersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($usersTable[0])) {
            $users = $usersTable;
        } else {
            die('No users found!');
        }

        return $users;
    }

    public static function getUser($username)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT id, email, firstname, lastname, accountCreatedTimestamp FROM users WHERE email = :username';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $usersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($usersTable[0])) {
            $user = $usersTable[0];
        } else {
            //die('No user with username = ' . $username);
            $user = null;
        }

        return $user;
    }

    public static function getUserRole($userId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql1 = 'SELECT * FROM teachers WHERE teacherId = :userId';
            $sql2 = 'SELECT * FROM admins WHERE adminId = :userId';
            $sql3 = 'SELECT * FROM studenten WHERE studentId = :userId';

            $stmt1 = $conn->prepare($sql1);
            $stmt1->bindParam(':userId', $userId);
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(':userId', $userId);
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bindParam(':userId', $userId);

            $stmt1->execute();
            $stmt2->execute();
            $stmt3->execute();

            $teachersTable = $stmt1->fetchAll(PDO::FETCH_CLASS);
            $studentsTable = $stmt3->fetchAll(PDO::FETCH_CLASS);
            $adminsTable = $stmt2->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($studentsTable[0])) {
            return "STUDENT";
        } else if (isset($teachersTable[0])) {
            return "LEERKRACHT";
        } else if (isset($adminsTable[0])) {
            return "ADMIN";
        } else {
            die("user does not have a role yet");
        }
    }

    public static function getUserById($userId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT id,email,firstname,lastname,accountCreatedTimestamp FROM users WHERE id = :userId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $usersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($usersTable[0])) {
            $user = $usersTable[0];
        } else {
            //die('No user with username = ' . $userId);

        }

        return $user;
    }

    public static function getLoggedInUserId($token)
    {
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

        if (isset($usersTable[0])) {
            $userId = $usersTable[0];
        } /*else {
            die('No userId found');
        }*/

        return $userId;
    }

    public static function getToken($token)
    {
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

        if (isset($tokenTable[0])) {
            $token = $tokenTable[0];
        } /*else {
            die('No userId found');
        }*/

        return $token;
    }

    public static function searchStudents($query)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = '    SELECT * FROM users WHERE ((firstname LIKE :query)
								                    OR (lastname LIKE :query)
								                    OR CONCAT(firstname, " ", lastname) LIKE :query
								                    OR CONCAT(lastname, " ", firstname) LIKE :query
							                  ) AND (id IN (SELECT studentId FROM studenten))';

            $stmt = $conn->prepare($sql);
            $query = '%' . $query . '%';
            $stmt->bindParam(':query', $query, PDO::PARAM_STR);
            $stmt->execute();

            $studentsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($studentsTable[0])) {
            $students = $studentsTable;
        } else {
            die('no students found');
        }

        return $students;
    }

    /*public static function searchEducations() {
      return;
    }*/

    public static function getAllStudents()
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM users WHERE id IN (SELECT studentId FROM studenten)';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $studentsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($studentsTable[0])) {
            $students = $studentsTable;
        } else {
            die('No users found!');
        }

        return $students;
    }

    public static function getEducationFromStudent($studentId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT DISTINCT o.id, o.name from studenten s
		            JOIN studenten_modules sm ON sm.studentId = s.studentId
                    JOIN modules m ON sm.moduleId = m.id
                    LEFT JOIN opleidingen o ON m.opleidingId = o.id OR sm.opleidingId = o.id
                    WHERE s.studentId = :studentId
					  AND s.stillStudent = TRUE
                      AND sm.status = \'volgt\'';

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId', $studentId);

            $stmt->execute();

            $educationsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($educationsTable[0])) {
            $education = $educationsTable[0];
        } else {
            //die('Student has no education!');
            $education = null;
        }

        return $education;
    }

    public static function getAllActiveStudentsWithEducation()
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT DISTINCT u.id, u.email, u.firstname, u.lastname, o.id as opleidingId, o.name as opleidingName from studenten s
                    JOIN users u ON s.studentId = u.id
		            JOIN studenten_modules sm ON sm.studentId = s.studentId
                    JOIN modules m ON sm.moduleId = m.id
                    LEFT JOIN opleidingen o ON m.opleidingId = o.id OR sm.opleidingId = o.id
                    WHERE s.stillStudent = TRUE
                      AND sm.status = \'volgt\'
                      AND u.status = \'ACTIVE\'';

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $studentsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($studentsTable[0])) {
            $students = $studentsTable;
        } else {
            //die('No students found!');
            $students = null;
        }

        return $students;
    }

    public static function getAllStudentsInEducation($educationId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT DISTINCT u.* FROM users u
		              JOIN studenten s on u.id = s.studentId
	                  JOIN studenten_modules sm ON s.studentId = sm.studentId
                      JOIN modules m ON sm.moduleId = m.id
                      WHERE sm.status = \'volgt\'
			            AND m.opleidingId = :educationId OR sm.opleidingId = :educationId';

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':educationId', $educationId);

            $stmt->execute();

            $studentsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($studentsTable[0])) {
            $students = $studentsTable;
        } else {
            //die('No students found!');
            $students = null;
        }

        return $students;
    }

    public static function getAllEducations()
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM opleidingen';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $educationsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($educationsTable[0])) {
            $educations = $educationsTable;
        } else {
            //die('No educations found!');
            $educations = null;
        }

        return $educations;
    }

    public static function getEducation($educationId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM opleidingen WHERE id = :educationId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':educationId', $educationId);

            $stmt->execute();

            $educationsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($educationsTable[0])) {
            $education = $educationsTable[0];
        } else {
            //die('No education found with id '.$educationId);
            $education = null;
        }

        return $education;
    }

    public static function getEducationByName($educationName)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM opleidingen WHERE name = :educationName';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':educationName', $educationName);

            $stmt->execute();

            $educationsTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($educationsTable[0])) {
            $education = $educationsTable[0];
        } else {
            //die('No education found with id '.$educationId);
            $education = null;
        }

        return $education;
    }

    public static function getAllMessages()
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM meldingen ORDER BY id DESC';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $messagesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($messagesTable[0])) {
            $messages = $messagesTable;
        } else {

            die('No messages found!');
        }

        return $messages;
    }

    public static function getAllTeachers()
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM users WHERE id IN (SELECT teacherId FROM teachers)';
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $teachersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($teachersTable[0])) {
            $teachers = $teachersTable;
        } else {
            die('No teachers found!');
        }

        return $teachers;
    }

    public static function getTeacherById($teacherId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM users u JOIN teachers t ON u.id = t.teacherId WHERE teacherId = :teacherId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':teacherId', $teacherId);

            $stmt->execute();

            $teachersTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($teachersTable[0])) {
            $teacher = $teachersTable[0];
        } else {
            die('No teacher found with id = ' . $teacherId);
        }

        return $teacher;
    }

    public static function getModulesInOpleiding($opleidingId)
    {
        try {
            $conn = graderdb::getConnection();

            if ($opleidingId == null) $sql = 'SELECT * FROM modules WHERE opleidingId is null';
            else $sql = 'SELECT * FROM modules WHERE opleidingId = :opleidingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':opleidingId', $opleidingId);

            $stmt->execute();

            $modulesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($modulesTable[0])) {
            $modules = $modulesTable;
        } else {
            //die('No modules found!');
            $modules = null;
        }

        return $modules;
    }

    public static function getModule($moduleId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM modules WHERE id = :moduleId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':moduleId', $moduleId);

            $stmt->execute();

            $modulesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($modulesTable[0])) {
            $module = $modulesTable[0];
        } else {
            //die('No module found with id '.$moduleId.'!');
            $module = null;
        }

        return $module;
    }

    public static function getModulesFromStudent($studentId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT DISTINCT m.* FROM studenten_modules sm
                      JOIN modules m ON sm.moduleId = m.id
                      -- JOIN opleidingen o ON sm.opleidingId = o.id -- geeft de algemene modules, niet specifiek aan de opleiding
                      -- JOIN opleidingen o ON m.opleidingId = o.id -- geeft de opleidingsspecifieke modules
                      WHERE sm.status = \'volgt\'
	                    AND sm.studentId = :studentId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId', $studentId);

            $stmt->execute();

            $moduleTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($moduleTable[0])) {
            $modules = $moduleTable;
        } else {
            die('No modules found for student with id = ' . $studentId);
        }
        return $modules;
    }

    public static function getDoelstellingscategoriesInModule($moduleId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM doelstellingscategories WHERE moduleId = :moduleId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':moduleId', $moduleId);

            $stmt->execute();

            $doelstellingscategoriesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($doelstellingscategoriesTable[0])) {
            $doelstellingscategorieen = $doelstellingscategoriesTable;
        } else {
            //die('No doelstellingscategorieën found!');
            $doelstellingscategorieen = null;
        }
        return $doelstellingscategorieen;
    }

    public static function getFollowedModules($studentId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT m.* FROM studenten_modules sm
                      JOIN modules m on sm.moduleId = m.id
                      WHERE studentId = :studentId
                        AND status=\'volgt\'';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId', $studentId);

            $stmt->execute();

            $modulesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($modulesTable[0])) {
            $modules = $modulesTable;
        } else {
            die('No modules found for student with id = ' . $studentId);
        }

        return $modules;
    }

    public static function getDoelstellingenInDoelstellingscategorie($doelstellingscategorieId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from doelstellingen
                    WHERE doelstellingscategorieId = :doelstellingscategorieId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':doelstellingscategorieId', $doelstellingscategorieId);

            $stmt->execute();

            $doelstellingenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($doelstellingenTable[0])) {
            $doelstellingen = $doelstellingenTable;
        } else {
            //die('No doelstellingen found for doelstellingscategorie with id = ' . $doelstellingscategorieId);
            $doelstellingen = null;
        }

        return $doelstellingen;
    }

    public static function getCriteriaInDoelstelling($doelstellingId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from evaluatiecriteria
                    WHERE doelstellingId = :doelstellingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':doelstellingId', $doelstellingId);

            $stmt->execute();

            $criteriaTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($criteriaTable[0])) {
            $criteria = $criteriaTable;
        } else {
            //die('No criteria found for doelstelling with id = ' . $doelstellingId);
            $criteria = null;
        }

        return $criteria;
    }

    public static function getBeoordelingsaspectenInEvaluatiecriterium($evaluatiecriteriumId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from aspecten
                    WHERE evaluatiecriteriumId = :evaluatiecriteriumId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatiecriteriumId', $evaluatiecriteriumId);

            $stmt->execute();

            $aspectenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($aspectenTable[0])) {
            $aspecten = $aspectenTable;
        } else {
            //die('No aspecten found for evaluatiecriterium with id = ' . $evaluatiecriteriumId);
            $aspecten = null;
        }

        return $aspecten;
    }

    public static function getAllEvaluaties($studentId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from evaluaties WHERE studentId = :studentId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId', $studentId);

            $stmt->execute();

            $evaluatiesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($evaluatiesTable[0])) {
            $evaluaties = $evaluatiesTable;
        } else {
            //die('No evaluaties found for student with id = ' . $studentId);
            $evaluaties = null;
        }

        return $evaluaties;
    }

    public static function getEvaluaties($studentId, $moduleId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from evaluaties WHERE studentId = :studentId AND moduleId = :moduleId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId', $studentId);
            $stmt->bindParam(':moduleId', $moduleId);

            $stmt->execute();

            $evaluatiesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($evaluatiesTable[0])) {
            $evaluaties = $evaluatiesTable;
        } else {
            //die('No rapporten found for student with id = ' . $studentId);
            $evaluaties = null;
        }

        return $evaluaties;
    }

    public static function getEvaluatieId($evaluatieName)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT id FROM evaluaties WHERE name = :evaluatieName';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieName', $evaluatieName);

            $stmt->execute();

            $evaluatiesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($evaluatiesTable[0])) {
            $evaluatieId = $evaluatiesTable[0]->id;
        } else {
            //die('No rapporten found for student with id = ' . $studentId);
            $evaluatieId = null;
        }

        return $evaluatieId;
    }

    public static function getRapportId($rapportName, $studentId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT id FROM rapporten WHERE name = :rapportName AND studentId = :studentId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId', $studentId);
            $stmt->bindParam(':rapportName', $rapportName);

            $stmt->execute();

            $rapportenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($rapportenTable[0])) {
            $rapportId = $rapportenTable[0]->id;
        } else {
            //die('No rapport found');
            $rapportId = null;
        }
        return $rapportId;
    }

    public static function getEvaluatie($evaluatieId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from evaluaties WHERE id = :evaluatieId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieId', $evaluatieId);

            $stmt->execute();

            $evaluatieTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($evaluatieTable[0])) {
            $evaluatie = $evaluatieTable[0];
        } else {
            //die('No evaluatie found with id = ' . $evaluatieId);
            $evaluatie = null;
        }
        return $evaluatie;
    }



    public static function getAspectbeoordeling($evaluatieId, $aspectId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM evaluaties_aspecten WHERE evaluatieId = :evaluatieId AND aspectId = :aspectId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieId', $evaluatieId);
            $stmt->bindParam(':aspectId',$aspectId);

            $stmt->execute();

            $doelstellingenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($doelstellingenTable[0])) {
            $rating = $doelstellingenTable[0];
        } else {
            //die('No score found for doelstelling with id '.$doelstellingId.' in rapport with id '.$rapportId.'!');
            $rating = null;
        }

        return $rating;
    }

    public static function getAspectbeoordelingen($evaluatieId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM evaluaties_aspecten WHERE evaluatieId = :evaluatieId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieId', $evaluatieId);

            $stmt->execute();

            $doelstellingenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($doelstellingenTable[0])) {
            $rating = $doelstellingenTable;
        } else {
            //die('No score found for doelstelling with id '.$doelstellingId.' in rapport with id '.$rapportId.'!');
            $rating = null;
        }

        return $rating;
    }

    public static function getRapporten($studentId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from rapporten WHERE studentId = :studentId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentId', $studentId);

            $stmt->execute();

            $rapportenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($rapportenTable[0])) {
            $rapporten = $rapportenTable;
        } else {
            //die('No rapporten found for student with id = ' . $studentId);
            $rapporten = null;
        }

        return $rapporten;
    }

    public static function getRapport($rapportId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from rapporten WHERE id = :rapportId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);

            $stmt->execute();

            $rapportTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($rapportTable[0])) {
            $rapport = $rapportTable[0];
        } else {
            //die('No rapporten found for student with id = ' . $studentId);
            $rapport = null;
        }

        return $rapport;
    }

    public static function getRapportmodules($rapportId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from rapporten_modules WHERE rapportId = :rapportId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);

            $stmt->execute();

            $modulesTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($modulesTable[0])) {
            $modules = $modulesTable;
        } else {
            //die('No modules found in rapport with id = ' . $rapportId);
            $modules = null;
        }
        return $modules;
    }

    public static function getRapportScore($rapportId, $doelstellingId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM rapporten_scores WHERE rapportId = :rapportId AND doelstellingId = :doelstellingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);
            $stmt->bindParam(':doelstellingId',$doelstellingId);

            $stmt->execute();

            $doelstellingenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($doelstellingenTable[0])) {
            $score = $doelstellingenTable[0];
        } else {
            //die('No score found for doelstelling with id '.$doelstellingId.' in rapport with id '.$rapportId.'!');
            $score = null;
        }

        return $score;
    }

    public static function getRapportscores($rapportId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * from rapporten_scores WHERE rapportId = :rapportId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);

            $stmt->execute();

            $scoresTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($scoresTable[0])) {
            $scores = $scoresTable;
        } else {
            //die('No scores found in rapport with id = ' . $rapportId);
            $scores = null;
        }
        return $scores;
    }

    public static function getRating($rapportId, $doelstellingId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'SELECT * FROM rapporten_scores WHERE rapportId = :rapportId AND doelstellingId = :doelstellingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);
            $stmt->bindParam(':doelstellingId', $doelstellingId);

            $stmt->execute();

            $doelstellingenTable = $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (isset($doelstellingenTable[0])) {
            $rating = $doelstellingenTable[0];
        } else {
            //die('No score found for doelstelling with id '.$doelstellingId.' in rapport with id '.$rapportId.'!');
            $rating = null;
        }

        return $rating;
    }

    public static function getUserPw($username)
    {
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

        if (isset($usersTable[0])) {
            $user = $usersTable[0];
        } else {
            //die('No user with username = ' . $username);
            $user = null;
        }

        return $user;
    }

    //////////////////////////////////////////////
    //              INSERT-QUERIES              //
    //////////////////////////////////////////////

    public static function createUser($firstname, $lastname, $email, $password, $creatorId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO users(firstname,lastname,email,password,creatorId) VALUES(:firstname, :lastname, :email, :password, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function makeUserStudent($userId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO studenten(studentId) VALUES(:userId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function createEducation($name, $creatorId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO opleidingen(name, creatorId) VALUES(:name, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

            $id = $conn->lastInsertId();

            return $id;

        } catch (PDOException $e) {
            die($e->getMessage());
            return null;
        }
    }

    public static function createModule($name, $opleidingId, $teacherId, $creatorId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO modules(name, opleidingId, teacherId, creatorId) VALUES(:name, :opleidingId, :teacherId, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':opleidingId', $opleidingId);
            $stmt->bindParam(':teacherId', $teacherId);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

            $id = $conn->lastInsertId();

            return $id;

        } catch (PDOException $e) {
            die($e->getMessage());
            return null;
        }
    }

    public static function createDoelstellingscategorie($name, $moduleId, $creatorId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO doelstellingscategories(name, moduleId, creatorId) VALUES(:name, :moduleId, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':moduleId', $moduleId);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

            $id = $conn->lastInsertId();

            return $id;

        } catch (PDOException $e) {
            die($e->getMessage());
            return null;
        }
    }

    public static function createDoelstelling($name, $doelstellingscategorieId, $creatorId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO doelstellingen(doelstellingscategorieId,name,creatorId) VALUES(:doelstellingscategorieId, :name, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':doelstellingscategorieId', $doelstellingscategorieId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

            $id = $conn->lastInsertId();

            return $id;

        } catch (PDOException $e) {
            die($e->getMessage());
            return null;
        }
    }

    public static function createEvaluatiecriteria($name, $doelstellingId, $creatorId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO evaluatiecriteria(doelstellingId, name, creatorId) VALUES(:doelstellingId, :name, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':doelstellingId', $doelstellingId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

            $id = $conn->lastInsertId();

            return $id;

        } catch (PDOException $e) {
            die($e->getMessage());
            return null;
        }
    }

    public static function createAspect($name, $evaluatiecriteriumId, $creatorId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO aspecten(evaluatiecriteriumId, name, creatorId) VALUES(:evaluatiecriteriumId, :name, :creatorId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatiecriteriumId', $evaluatiecriteriumId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':creatorId', $creatorId);
            $stmt->execute();

            $id = $conn->lastInsertId();

            return $id;

        } catch (PDOException $e) {
            die($e->getMessage());
            return null;
        }
    }

    /*
        public static function addStudentToModules($studentId, $moduleIds){ // TODO opleidingId for general modules?
            try {
                $conn = graderdb::getConnection();

                $sql = 'INSERT INTO studenten_modules (moduleId, studentId) VALUES ';

                $sql .= '(:studentId, '.$moduleIds[0].')';

                for($i = 1; $i < sizeof($moduleIds); $i++){
                    $sql .= ',(:studentId, '.moduleIds[$i].')'; // TODO parameter binding !!!
                }

                $sql .= ";";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':studentId', $studentId);

                $stmt->execute();
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }*/

    public static function insertNewLoginToken($userId, $token)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO loginTokens(token, userId) VALUES(:token, :userId)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':userId', $userId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function insertNewEvaluation($name, $studentId, $moduleId, $date)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO evaluaties(name, studentId, moduleId, datum) VALUES (:name, :studentId, :moduleId, :datum)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':studentId', $studentId);
            $stmt->bindParam(':moduleId', $moduleId);
            $stmt->bindParam(':datum', $date);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function insertAspectbeoordelingen($evaluatieId, $aspectscoresKeyValueArray)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO evaluaties_aspecten (evaluatieId, aspectId, aspectBeoordeling) VALUES ';

            $aspectIds = array_keys($aspectscoresKeyValueArray);
            $aspectScores = array_values($aspectscoresKeyValueArray);

            $sql .= '(:evaluatieId, ' . $aspectIds[0] . ', "' . $aspectScores[0] . '")';

            for ($i = 1; $i < sizeof($aspectscoresKeyValueArray); $i++) {
                if ($aspectScores[$i] !== null) $sql .= ',(:evaluatieId, ' . $aspectIds[$i] . ', "' . $aspectScores[$i] . '")'; // TODO parameter binding !!!
            }

            $sql .= ";";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieId', $evaluatieId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function insertNewReport($name, $studentId, $startdate, $enddate, $commentaarKlassenraad, $commentaarAlgemeen)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO rapporten (name, studentId, startdate, enddate, commentaarKlassenraad, commentaarAlgemeen)
                        VALUES (:name, :studentId, :startdate, :enddate, :commentaarKlassenraad, :commentaarAlgemeen)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':studentId', $studentId);
            $stmt->bindParam(':startdate', $startdate);
            $stmt->bindParam(':enddate', $enddate);
            $stmt->bindParam(':commentaarKlassenraad', $commentaarKlassenraad);
            $stmt->bindParam(':commentaarAlgemeen', $commentaarAlgemeen);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function insertRapportModules($rapportId, $moduleIdEnCommentaarKeyValueArray)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO rapporten_modules (rapportId, moduleId, commentaar) VALUES ';

            $first = true;
            foreach($moduleIdEnCommentaarKeyValueArray as $moduleId => $commentaar){
                if($first == true){
                    $sql .= '(:rapportId, '.$moduleId.', "'.$commentaar. '")'; // TODO parameter binding
                } else {
                    $sql .= ', (:rapportId, '.$moduleId.', "'.$commentaar. '")'; // TODO parameter binding
                }
                $first = false;
            }

            $sql .= ";";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function insertRapportscores($rapportId, $puntenEnCommentaarThreeDimensionalArray)
    {
        // berekenen
        // avg(rating 'aspecten' (OK/NOK)) = rating evaluatiecriterium (RO/OV/V/G/Afwezig/Voldaan(NVT))
        // avg(rating evaluatiecriteria) = rating doelstelling
        // leerkracht kan dit met 1 stap aanpassen (bv als het gemiddelde OV is maar de leerkracht vindt het ok kan deze hier V van maken, of omgekeerd)

        try {
            $conn = graderdb::getConnection();

            $sql = 'INSERT INTO rapporten_scores (rapportId, doelstellingId, score, opmerking) VALUES ';

            //(array_keys($puntenEnCommentaarThreeDimensionalArray)); // doelstellingIds
            //(array_column($puntenEnCommentaarThreeDimensionalArray,0)); // punten
            //(array_column($puntenEnCommentaarThreeDimensionalArray,1)); // commentaar

            $first = true;
            foreach($puntenEnCommentaarThreeDimensionalArray as $doelstellingsId => $scoreEnOpmerking){
                if($scoreEnOpmerking[0] !== null) {
                    if(!$first) $sql .= ', ';
                    $sql .= '(:rapportId, '.$doelstellingsId.', \''.$scoreEnOpmerking[0].'\', "'.$scoreEnOpmerking[1]. '")'; // TODO parameter binding
                    $first = false;
                }
            }

            $sql .= ";";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //////////////////////////////////////////////
    //              UPDATE-QUERIES              //
    //////////////////////////////////////////////

    public static function updateUser($firstName, $lastName, $email, $userId)
    {
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

    public static function updatePassword($userId, $password)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE users SET password=:password WHERE id = :userId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':userId', $userId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function updateOpleiding($opleidingId, $name)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE opleidingen SET name=:name WHERE id = :opleidingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':opleidingId', $opleidingId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function updateModule($moduleId, $name)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE modules SET name=:name WHERE id = :moduleId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':moduleId', $moduleId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function updateDoelstellingscategorie($doelstellingscategorieId, $name)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE doelstellingscategories SET name=:name WHERE id = :doelstellingscategorieId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':doelstellingscategorieId', $doelstellingscategorieId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function updateDoelstelling($doelstellingId, $name)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE doelstellingen SET name=:name WHERE id = :doelstellingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':doelstellingId', $doelstellingId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function updateEvaluatiecriteria($evaluatiecriteriaId, $name)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE evaluatiecriteria SET name=:name WHERE id = :evaluatiecriteriaId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':evaluatiecriteriaId', $evaluatiecriteriaId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function updateAspect($aspectId, $name)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE aspecten SET name=:name WHERE id = :aspectId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':aspectId', $aspectId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function updateEvaluatie($evaluatieId, $evaluatieName, $datum, $aspectscoresKeyValueArray)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE evaluaties SET name=:evaluatieName, datum=:datum WHERE id = :evaluatieId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieId', $evaluatieId);
            $stmt->bindParam(':evaluatieName', $evaluatieName);
            $stmt->bindParam(':datum', $datum);

            $stmt->execute();

            //$aspectIds = array_keys($aspectscoresKeyValueArray);
            //$aspectScores = array_values($aspectscoresKeyValueArray);

            $newAspects = [];
            $nietBeoordeeldeAspectIds = [];

            foreach($aspectscoresKeyValueArray as $aspectId => $aspectScore)
            {
                if(isset($aspectScore)) {
                    $bestaandeQuotering = self::getAspectbeoordeling($evaluatieId, $aspectId);
                    if(isset($bestaandeQuotering)){
                        $sql2 = 'UPDATE evaluaties_aspecten SET aspectBeoordeling = :aspectBeoordeling WHERE evaluatieId = :evaluatieId AND aspectId = :aspectId'; // TODO mogelijke manier om aantal calls te verminderen?
                        $stmt = $conn->prepare($sql2);
                        $stmt->bindParam(':evaluatieId', $evaluatieId);
                        $stmt->bindParam(':aspectId', $aspectId);
                        $stmt->bindParam(':aspectBeoordeling', $aspectScore);

                        $stmt->execute();
                    } else {
                        $newAspects[$aspectId] = $aspectScore;
                    }
                } else {
                    array_push($nietBeoordeeldeAspectIds, $aspectId);
                }
            }

            if(sizeof($newAspects) > 0) self::insertAspectbeoordelingen($evaluatieId, $newAspects);
            if(sizeof($nietBeoordeeldeAspectIds) > 0) self::deleteAspectscores($evaluatieId, $nietBeoordeeldeAspectIds);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function updateRapport($rapportId, $rapportName, $startdatum, $einddatum, $moduleIdsEnCommentaarKeyValueArray, $scoresEnOpmerkingenThreeDimensionalArray, $commentaarAlgemeen, $commentaarKlassenraad, $commentaarWerkplaats)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE rapporten SET name = :name, startdate = :startdate, enddate = :enddate, commentaarKlassenraad = :commentaarKlassenraad, commentaarAlgemeen = :commentaarAlgemeen, commentaarWerkplaats = :commentaarWerkplaats WHERE id = :rapportId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);
            $stmt->bindParam(':name', $rapportName);
            $stmt->bindParam(':startdate', $startdatum);
            $stmt->bindParam(':enddate', $einddatum);
            $stmt->bindParam(':commentaarKlassenraad', $commentaarKlassenraad);
            $stmt->bindParam(':commentaarAlgemeen', $commentaarAlgemeen);
            $stmt->bindParam(':commentaarWerkplaats', $commentaarWerkplaats);

            $stmt->execute();

            //$moduleIds = array_keys($moduleIdsEnCommentaarKeyValueArray);
            //$moduleCommentaren = array_values($moduleIdsEnCommentaarKeyValueArray);

            foreach($moduleIdsEnCommentaarKeyValueArray as $moduleId => $moduleCommentaar)
            {
                $sql2 = 'UPDATE rapporten_modules SET commentaar = :moduleCommentaar WHERE moduleId = :moduleId AND rapportId = :rapportId';
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':moduleCommentaar', $moduleCommentaar);
                $stmt2->bindParam(':moduleId', $moduleId);
                $stmt2->bindParam(':rapportId', $rapportId);

                $stmt2->execute();
            }

            $newScores = [];
            $nietBeoordeeldeDoelstellingIds = [];

            foreach($scoresEnOpmerkingenThreeDimensionalArray as $doelstellingId => $scoreEnOpmerking)
            {
                $score = $scoreEnOpmerking[0];
                $opmerking = $scoreEnOpmerking[1];
                if(isset($score)) {
                    $bestaandResultaat = self::getRapportscore($rapportId, $doelstellingId);
                    if (isset($bestaandResultaat)) {

                        $sql3 = 'UPDATE rapporten_scores SET score = :score, opmerking = :opmerking WHERE doelstellingId = :doelstellingId AND rapportId = :rapportId';
                        $stmt3 = $conn->prepare($sql3);
                        $stmt3->bindParam(':score', $score);
                        $stmt3->bindParam(':opmerking', $opmerking);
                        $stmt3->bindParam(':doelstellingId', $doelstellingId);
                        $stmt3->bindParam(':rapportId', $rapportId);

                        $stmt3->execute();
                    } else {
                        $newScores[$doelstellingId] = array($score, $opmerking);
                    }
                } else {
                    array_push($nietBeoordeeldeDoelstellingIds, $doelstellingId);
                }
            }

            if(sizeof($newScores) > 0) self::insertRapportscores($rapportId, $newScores);
            if(sizeof($nietBeoordeeldeDoelstellingIds) > 0) self::deleteRapportScores($rapportId, $nietBeoordeeldeDoelstellingIds);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // TODO update student

    //////////////////////////////////////////////
    //              DELETE-QUERIES              //
    //////////////////////////////////////////////

    public static function deleteOpleiding($opleidingId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'DELETE FROM opleidingen WHERE id=:opleidingId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':opleidingId', $opleidingId);

            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function removeLoginToken($token)
    {
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

    public static function removeAllTokensFromUser($userId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'DELETE FROM loginTokens WHERE userId=:userId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userId', $userId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function deleteEvaluatie($evaluatieId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'DELETE FROM evaluaties_aspecten WHERE evaluatieId = :evaluatieId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieId', $evaluatieId);

            $stmt->execute();

            $sql = 'DELETE FROM evaluaties WHERE id = :evaluatieId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieId', $evaluatieId);

            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function deleteAspectscores($evaluatieId, $aspectIds){
        try {
            $conn = graderdb::getConnection();

            $sql = 'DELETE FROM evaluaties_aspecten WHERE evaluatieId = :evaluatieId AND aspectId IN (';
            $first = true;
            foreach($aspectIds as $aspectId){
                if(!$first) $sql .= ', ';
                $sql .= $aspectId; // TODO parameter binding?
                $first = false;
            }
            $sql .= ');';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':evaluatieId', $evaluatieId);

            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function deleteRapportScores($rapportId, $doelstellingIds){
        try {
            $conn = graderdb::getConnection();

            $sql = 'DELETE FROM rapporten_scores WHERE rapportId = :rapportId AND doelstellingId IN (';
            $first = true;
            foreach($doelstellingIds as $doelstellingId){
                if(!$first) $sql .= ', ';
                $sql .= $doelstellingId; // TODO parameter binding?
                $first = false;
            }
            $sql .= ');';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rapportId', $rapportId);

            $stmt->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    //                  FAKE DELETE-QUERIES THAT ARE ACTUALLY UPDATE QUERIES                  //
    //         because we not delete users and educations to keep the reports working         //
    ////////////////////////////////////////////////////////////////////////////////////////////

    public static function deleteAccount($userId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE users SET status="DISABLED" WHERE id = :userId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userId', $userId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function deleteEducation($educationId)
    {
        try {
            $conn = graderdb::getConnection();

            $sql = 'UPDATE opleidingen SET active=false WHERE id = :educationId';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':educationId', $educationId);

            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
