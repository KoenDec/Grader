<?php
include_once "header.html";
include_once "showFunctions.php";

session_start();


if(isset($_SESSION['username'])){
    showNavigation($_SESSION['username']);
    checkGET();
}
elseif(isset($_POST['username'])){
    $_SESSION['username'] = $_POST['username'];
    showNavigation($_SESSION['username']);
    checkGET();
}
else{
    showLogin();
}

function checkGET()
{
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case "account":
                showAccount();
                break;

            case "afmelden":
                unset($_SESSION["username"]);
                header("Refresh:0; url=index.php");
                break;

            case "rapporten":
                showReportsPage();
                break;

            case "studenten":
                showStudentsPage();
                break;

            case "richtingen":
                showSubjectPage();
                break;

            case "meldingen":
                showMessagesPage();
                break;
        }

    } else {
        showStart();
    }
}

include_once "footer.html";
?>