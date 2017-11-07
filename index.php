<?php
include_once "header.html";
include_once "showFunctions.php";
include_once "graderdb.php";
include_once('Login.php');

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
                showReportsPage();
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
                if(isset($_POST["opleiding-name"]))
                {
                    $userDAO->createEducation($_POST["opleiding-name"], $loggedInUserId);
                    showAddModuleToOpleidingPage($_POST["opleiding-name"]);
                }
                break;
        }

    } else {
        showStart();
    }
}

include_once "footer.html";
?>
