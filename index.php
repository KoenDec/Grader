<?php
include_once "header.html";
include_once "php/showFunctions.php";
include_once "php/graderdb.php";
include_once('php/Login.php');

$userDAO = new UserDAO();

$currentUser;
if (Login::isLoggedIn()) {
    $currentUser = $userDAO->getUserById(Login::isLoggedIn());

    checkGET();
} else {
    showLogin();
}

function checkGET()
{
    $currentUser = $GLOBALS['currentUser'];
    $loggedInUserId = Login::isLoggedIn();
    $userDAO = new userDAO();

    showNavigation($currentUser->firstname . ' ' . $currentUser->lastname,$loggedInUserId);

    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case "account":
                if(isset($_POST["account-FirstName"])){
                    $userDAO->updateUser($_POST["account-FirstName"], $_POST["account-LastName"], $_POST["student-email"], $loggedInUserId);
                }
                showAccount($GLOBALS['currentUser']->email);
                break;

            case "afmelden": // TODO via api or logout.php
                header("Refresh:0; url=index.php");
                break;

            case "rapporten":
                var_dump($_POST);
                if(isset($_POST["rapport-id"]) && isset($_POST["student-id"])) {
                    showReportsPage($_POST["student-id"], $_POST["rapport-id"]);
                }
                else if(isset($_POST["rapport-id"])) {
                    showReportsPage(null, $_POST["rapport-id"]);
                }
                else if(isset($_POST["student-id"])){
                    showReportsPage($_POST["student-id"], null);
                } else {
                    showReportsPage(null, null);
                }
                break;
            case "werkfiches":
                var_dump($_POST);
                if(isset($_POST["student-id"]) && isset($_POST["module-id"])) {
                    showWerkfichesPage($_POST["student-id"],$_POST["module-id"]);
                }
                if(isset($_POST["student-id"])) {
                    showWerkfichesPage($_POST["student-id"], null);
                } else {
                    showWerkfichesPage(null, null);
                }
                break;

            case "studenten":
                showStudentsPage();
                break;

            case "opleidingen":
                showSubjectPage();
                break;

            case "meldingen":
                showMessagesPage();
                break;

            case "afdrukken":
                showPrintPage();
                break;

            case "editStudent":
                ShowStudentAddPage();
                break;

            case "editStudentModules":
                $opleidingId = $_POST["student-opleidingId"];
                $userEmail = $_POST["student-email"];
                $userId = "";

                if(isset($_POST["student-email"])){
                    $user = $userDAO->getUser($_POST["student-email"]);
                    if(isset($user)) { // user bestaat al --> modules laden om aan te passen
                        $userId = $user->id;
                        // TODO update other fields
                    }
                    else { // nieuwe student aanmaken en toon modules uit gekozen opleiding
                        $userDAO->createUser($_POST["student-firstname"],$_POST["student-name"],$userEmail,"pw",$loggedInUserId); // TODO random wachtwoord genereren en emailen naar user
                        $userId = $userDAO->getUser($userEmail)->id;
                        $userDAO->makeUserStudent($userId);
                    }
                }
                showStudentEditModulesPage($opleidingId, $userId);
                break;

            case "editOpleiding":
                showOpleidingAddPage();
                break;

            case "addModuleToOpleiding":
                var_dump($_POST);
                if(isset($_POST["module-name"])){
                    $userDAO->createModule($_POST["module-name"],$_POST["opleiding-id"],$loggedInUserId);
                    showAddModuleToOpleidingPage($userDAO->getEducation($_POST["opleiding-id"]));
                }
                else if(isset($_POST["opleiding-name"]))
                {
                    $opleidingNaam = $_POST["opleiding-name"];
                    $userDAO->createEducation($opleidingNaam, $loggedInUserId);
                    $opleiding = $userDAO->getEducationByName($opleidingNaam);
                    showAddModuleToOpleidingPage($opleiding);
                }
                break;
        }

    } else {
        showStart();
    }
}

include_once "footer.html";
?>
