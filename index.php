<?php
include_once "header.html";
include_once "showFunctions.php";
include_once "graderdb.php";
include_once('Login.php');

$userDAO = new UserDAO();

$currentUser;
if (Login::isLoggedIn()) {
  $currentUser = $userDAO->getUserById(Login::isLoggedIn());
  showNavigation($currentUser->firstname . ' ' . $currentUser->lastname);
  checkGET();
} else {
  showLogin();
}

function checkGET()
{
    $userDAO = new userDAO();
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case "account":
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
                if(isset($_POST["opleiding-name"]))
                {
                    $userDAO->createEducation($_POST["opleiding-name"],$userDAO->getUser($GLOBALS['currentUser'])->id);
                }
                showSubjectPage();
                break;

            case "meldingen":
                showMessagesPage();
                break;

            case "afdrukken":
                showPrintPage();
                break;

            case "editStudent":
                showStudentEditPage();
                break;

            case "editOpleiding":
                showOpleidingAddPage();
                break;
        }

    } else {
        showStart();
    }
}

include_once "footer.html";
?>
