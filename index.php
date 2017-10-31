<?php
include_once "header.html";
include_once "showFunctions.php";
include_once "graderdb.php";
include_once('Login.php');

//session_start();
$userDAO = new UserDAO();

$currentUser = '';
if (Login::isLoggedIn()) {
  $currentUser = $userDAO->getUserById(Login::isLoggedIn())->email;
  showNavigation($currentUser);
  checkGET();
} else {
  showLogin();
}

/*if(isset($_SESSION['email'])){
    showNavigation($_SESSION['name']);
    checkGET();
}elseif(isset($_POST['email'])){
    $_SESSION['email'] = $_POST['email'];
    showNavigation($_SESSION['name']);
    checkGET();
}else{
    showLogin();
}*/
function checkGET()
{
    $userDAO = new userDAO();
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case "account":
                showAccount($_SESSION['email']);
                break;

            case "afmelden":
                unset($_SESSION['email']);
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
                    $userDAO->createEducation($_POST["opleiding-name"],$userDAO->getUser($_SESSION['email'])->id);
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
