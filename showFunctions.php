<?php

require_once('graderdb.php');



/**************************
 *   REUSABLE FUNCTIONS   *
 **************************/

function showEducationsCheckboxes($onlyGuiFunction){
    $userDAO = new UserDAO();
    $educations = $userDAO->getAllEducations();
    if($onlyGuiFunction) {
        $educationIds = array();
        echo '<form class="col s3" action="#" ';
    } else {
        echo '<span ';
    }
    echo 'id="educationsCheckboxes">';
    ?>
    <p>
        <input type="checkbox" id="all-checkboxes" checked="checked" />
        <label for="all-checkboxes">Alles selecteren</label>
    </p>

    <?php
    foreach($educations as $opleiding){
        if($onlyGuiFunction) array_push($educationIds, $opleiding->id);
        ?>
        <p class="opleiding-checkbox">
            <input type="checkbox" id="opleiding<?= $opleiding->id?>" checked="checked" />
            <label for="opleiding<?=$opleiding->id?>"><?=$opleiding->name?></label>
        </p>
        <?php
    }
    if($onlyGuiFunction) {
        echo '</form>';
        return $educationIds;
    } else {
        echo '</span>';
    }
}



/**************************
 *     SPECIFIC PAGES     *
 **************************/


function showLogin(){
    ?>
    <div class="login centered z-depth-5">
        <form method="POST">
            <div class="row">
                <div class="input-field">
                    <input id="username" name="username" type="email" class="validate">
                    <label for="username">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">Wachtwoord</label>
                </div>
            </div>
            <!--<div class="row">
                <div class="g-recaptcha" id="captcha" data-sitekey="6LepDTQUAAAAAJQCkfOXuM_mxjH7wsgXfKYbPNKy"></div>
            </div>-->
            <button class="btn waves-effect waves-light" type="submit" name="action" id="login">Log in
                <i class="material-icons right">send</i>
            </button>
            <div id="error"></div>
        </form>
    </div>
    <?php
}

function showNavigation($name){
// todo Only show what is needed/allowed for the user
?>
<header>

    <nav>
        <div class="nav-wrapper nav-color">
            <ul class="right hide-on-med-and-down">
                <li><a class="dropdown-button" href="#!" data-activates="userDropdown"><?= $name ?><i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a href="#!" style="margin-right: 20px">Admin</a></li>
            </ul>
            <div class="left hide-on-med-and-down">
                <div class="button-collapse show-on-large pointer" data-activates="slide-out"><i class="material-icons">menu</i></div>
                <a href="index.php"><h4>Rapportensysteem</h4></a>
            </div>
        </div>
    </nav>

    <ul id="userDropdown" class="dropdown-content">
        <li><a href="index.php?page=account">Account</a></li>
        <li class="divider"></li>
        <li id="logout"><a href="" data-id=<?= $GLOBALS['currentUser']->id?>>Afmelden</a></li>
    </ul>

</header>

<ul id="slide-out" class="side-nav">
    <img src="images/CLW_Logo.png" class="school-logo"/>
    <li><div class="divider"></div></li>
    <li><a class="waves-effect" href="index.php?page=rapporten">Rapporten</a></li>
    <li><a class="waves-effect" href="index.php?page=studenten">Studenten</a></li>
    <li><a class="waves-effect" href="index.php?page=opleidingen">Opleidingen</a></li>
    <li><a class="waves-effect" href="index.php?page=meldingen">Meldingen<span class="new badge">1</span></div></a></li>
    <li><a class="waves-effect" href="index.php?page=afdrukken">Afdrukken</a></li>
</ul>

<main class="container"> <!-- don't mind this error, I do close the 'main' tag in the footer -->
    <?php
    }

    function showStart(){
        // todo Add actual startpage text
        ?>
        <h1>Welkom bij ons Rapportsysteem</h1>
        <p>
            Nulla lobortis aliquam placerat. Quisque at justo maximus, commodo diam sit amet, feugiat arcu. Mauris non suscipit ex, vitae tincidunt magna.
            Etiam neque sem, euismod ac odio vel, rhoncus interdum mauris. Morbi aliquet sollicitudin nisl, sit amet tempus lorem interdum sit amet.
            Nam sagittis tempus mattis. Etiam mattis eros eget eros vulputate, quis vestibulum lorem convallis. Suspendisse quis sollicitudin enim.
            Nulla metus dolor, venenatis ut lacus ut, dictum interdum ante. Sed suscipit mi at ante vulputate, quis maximus elit tempor.
            Nullam elementum venenatis commodo. Etiam vel tristique massa. Etiam libero mauris, posuere sed massa nec, tristique vehicula lacus.
            Donec lacinia, lorem et mattis tincidunt, lectus metus imperdiet mi, in tempor turpis lectus id lacus.
        </p>
        <?php
    }

    function showAccount($email){
        $userDAO = new UserDAO();
        $user = $userDAO->getUser($email);
        ?>
        <h2>Mijn account</h2>
        <table class="striped">
            <tr><td>Voornaam: <span><?= $user->firstname ?></span></td></tr>
            <tr><td>Familienaam: <span><?= $user->lastname ?></span></td></tr>
            <tr><td>Email: <span><?= $user->email ?></span></td></tr>
            <tr><td>Lid sinds: <span><?= $user->accountCreatedTimestamp ?></span></td></tr>
        </table>
        <a class="waves-effect waves-light btn tooltipped openPopup" data-delay="50" data-tooltip="Account wijzigen"><i class="material-icons">edit</i></a>

        <div class="popup centered hidden">
            <i class="popup-exit small material-icons right">cancel</i>
            <div class="row">
                <h4>Gegevens aanpassen</h4>
            </div>
            <form action="index.php?page=account" method="POST">
                <div class="row">
                    <div class="input-field">
                        <input id="account-FirstName" name="account-FirstName" type="text" value="<?= $user->firstname ?>">
                        <label for="account-FirstName">Voornaam</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input id="account-LastName" name="account-LastName" type="text" value="<?= $user->lastname ?>">
                        <label for="account-LastName">Naam</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input id="student-email" name="student-email" type="text" value="<?= $user->email ?>">
                        <label for="student-email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light popup-submit" type="submit" name="action">Aanpassingen opslaan
                        <i class="material-icons right">send</i>
                    </button>
                </div>

            </form>
        </div>
        </div>
        <?php
    }

    function showReportsPage(){
        $userDAO = new UserDAO();
        // todo now only student 1's report (hardcoded) is shown, create functionality for other students
        $studentId = 6; // faisal
        $modules = $userDAO->getModulesFromStudent($studentId);

        $dateNow = date('d/m/Y');

        if(!empty($_POST['student'])) {
            $selectedStudent = $_POST['student'];
        } else {
            $selectedStudent = 'nothing';
        }
        // todo don't show edit report button for students, that'd be weird  ;) (aslo show ONLY his report)
        ?>
        <div class="row">
            <h2>Rapporten</h2>
        </div>
        <div class="row">
            <div class="student-search input-field col s6">
                <input type="text" id="report-search" class="col s8 autocomplete" name="report-search" />
                <label for="report-search">Zoek student</label>
                <a class="waves-effect waves-light btn"><i class="material-icons">search</i></a>
                <ul class="autocomplete-content dropdown-content"></ul>
            </div>
            <div class="right-align col s6 reports-btns">
                <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Rapport downloaden"><i class="material-icons">file_download</i></a>
                <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Rapport afdrukken"><i class="material-icons">print</i></a>
            </div>
        </div>
        <div class="row selectedStudent">
            <p class="col s6">Studiemodules van: <span style="font-weight: bold">Faisal Nizami</span></p>
            <div class="right-align">
                <a class="waves-effect waves-light btn tooltipped edit-opslaan-rapport" data-editing="false" data-delay="50" data-tooltip="Aanpassen inschakelen"><i class="material-icons">edit</i></a>
            </div>
        </div>

        <ul class="popout collapsible courseCreator" data-collapsible="expandable">
            <?php
            // todo get students results and comments from database
            foreach($modules as $module){
                ?>

                <li>
                    <div class='valign-wrapper collapsible-header collapsible-module'><i class='collapse-icon material-icons'>add_box</i>
                        <h4><?= $module->name ?></h4>
                    </div>
                    <div class='collapsible-body'>
                        <table class="striped bordered">
                            <tr>
                                <th class="doelstellingwidth">Doelstellingen</th>
                                <th>Resultaat</th>
                                <th>Gemiddelde</th>
                                <th>Datum</th>
                                <th class="opmerkingenwidth">Opmerkingen</th>
                            </tr>
                            <tr>

                                <?php
                                $doelstellingen = $userDAO->getFollowedDoelstellingenInModule($module->id, $studentId);
                                foreach($doelstellingen as $doelstelling){
                                ?>
                                <th style="border-top: 2px solid gray; border-bottom: 2px solid gray" colspan="5"><strong><?= $doelstelling->name ?></strong></th>
                            </tr><tr>
                                <?php
                                $criteria = $userDAO->getCriteriaForDoelstelling($doelstelling->id);
                                foreach($criteria as $criterium){
                                ?>
                                <td style="padding-left: 30px" class="doelstellingwidth valign-wrapper"><i class="material-icons">navigate_next</i><?= $criterium->weergaveTitel ?></td>
                                <td contenteditable="false">
                                    <div class="input-field">
                                        <select class="hidden" disabled>
                                            <option value="" disabled selected>Niets geselecteerd</option>
                                            <option value="1">R</option>
                                            <option value="2">O</option>
                                            <option value="3">V</option>
                                            <option value="4">G</option>
                                        </select>
                                    </div>
                                    <p>
                                        <?php
                                        for($eerderResultaat = 0; $eerderResultaat < 5; $eerderResultaat++) {
                                            if($eerderResultaat > 0){
                                                echo ", ";
                                            }
                                            ?>
                                            <span class="eerder-resultaat tooltipped" data-delay="50" data-tooltip="20/10/17">O</span>
                                            <?php
                                        }
                                        ?>
                                    </p>
                                </td>
                                <td class="avg">O</td>  <!--todo Actualy calculate avg score-->
                                <td class="pickDate"><?= $dateNow ?></td>
                                <td class="opmerkingenwidth" >
                                    <div class="input-field">
                                        <input disabled  id="opmerkingen" type="text">
                                        <label for="opmerkingen">Opmerkingen</label>
                                    </div></td>
                            </tr><tr>
                                <?php
                                }

                                }
                                ?>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea disabled id="moduleComment" class="materialize-textarea"></textarea>
                                <label for="moduleComment">Commentaar bij deze module: </label>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
        <div class="row">
            <div class="input-field col s12">
                <textarea disabled id="generalComment" class="materialize-textarea"></textarea>
                <label for="generalComment">Algemeen commentaar:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea disabled id="klasraadComment" class="materialize-textarea"></textarea>
                <label for="klasraadComment">Commentaar klassenraad:</label>
            </div>
        </div>

        <?php
    }

    function showStudentsPage(){
        $userDAO = new UserDAO();

        ?>
        <div class="row">
            <h2>Studenten</h2>
        </div>
        <div class="row">
            <div class="student-search input-field col s6">
                <input type="text" id="student-search" class="col s8" name="student-search" />
                <label for="student-search">Zoek student</label>
                <a class="waves-effect waves-light btn"><i class="material-icons">search</i></a>
            </div>
            <div class="row">
                <div class="addstudent" style="position: relative; height: 90px;">
                    <div class="fixed-action-btn horizontal" style="position: absolute; display: inline-block; right: 24px;">
                        <a class="btn-floating waves-effect waves-light btn-large tooltipped" data-position="top" data-delay="50" data-tooltip="Student Toevoegen">
                            <i class="large material-icons">add</i>
                        </a>
                        <ul>
                            <li><a href="index.php?page=editStudent" class="btn-floating red tooltipped" data-position="top" data-delay="50" data-tooltip="Enkele student toevoegen"><i class="material-icons">person_add</i></a></li>
                            <li><a class="btn-floating yellow darken-1 tooltipped openPopup" data-delay="50" data-tooltip=".csv uploaden"><i class="material-icons">file_upload</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $educationIds = showEducationsCheckboxes(true);
            ?>
            <table class="col s9 striped bordered">
                <tr>
                    <th>Student</th>
                    <th>Acties</th>
                </tr>
                <?php
                foreach($educationIds as $id){
                    $students = $userDAO->getAllStudentsInEducation($id);

                    foreach($students as $student){
                        ?>
                        <tr data-opleidingId=<?=$id?>>
                            <td><?=$student->firstname?> <?=$student->lastname?> (<?=$student->email?>)</td>
                            <td>
                                <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Rapport bekijken"><i class="material-icons right">import_contacts</i>Rapport</a>
                                <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Studiemodule aanpassen"><i class="material-icons">edit</i></a>
                                <a class="waves-effect waves-light btn tooltipped red right" data-delay="50" data-tooltip="Delete Student"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }


                ?>
        </div>
        <div class="popup centered hidden">
            <i class="popup-exit small material-icons right">cancel</i>
            <div class="row">
                <h4>Studenten toevoegen</h4>
            </div>
            <form action="index.php?page=studenten" method="POST">
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" accept=".csv">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <button class="btn waves-effect waves-light popup-submit" type="submit" name="action">Studenten toevoegen
                        <i class="material-icons right">send</i>
                    </button>
                </div>

            </form>
        </div>
        </div>
        <?php
    }

    function showSubjectPage(){
    $userDAO = new UserDAO();
    $educations = $userDAO->getAllEducations();
    ?>
    <div class="row">
        <h2>Opleidingen</h2>
    </div>
    <div class="row">
        <div class="subject-search input-field col s6">
            <input type="text" id="subject-search" class="col s8" name="subject-search">
            <label for="subject-search">Zoek Opleiding</label>
            <a class="waves-effect waves-light btn"><i class="material-icons">search</i></a>
        </div>
        <div class="addSubject" style="position: relative; height: 90px;">
            <div class="fixed-action-btn horizontal" style="position: absolute; display: inline-block; right: 24px;">
                <a class="btn-floating waves-effect waves-light btn-large tooltipped" data-position="top" data-delay="50" data-tooltip="Opleiding Toevoegen">
                    <i class="large material-icons">add</i>
                </a>
                <ul>
                    <li><a href="index.php?page=editOpleiding" class="btn-floating red tooltipped" data-position="top" data-delay="50" data-tooltip="Enkele opleiding toevoegen"><i class="material-icons">library_add</i></a></li>
                    <li><a class="btn-floating yellow darken-1 tooltipped openPopup" data-delay="50" data-tooltip=".csv uploaden"><i class="material-icons">file_upload</i></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <table class="striped bordered">
                <tr>
                    <th>Opleiding</th>
                    <th width="200px">Acties</th>
                </tr>
                <?php
                foreach($educations as $opleiding){
                    ?>
                    <tr>
                        <td><?= $opleiding->name?></td>
                        <td>
                            <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Opleiding bewerken"><i class="material-icons">edit</i></a>
                            <a class="waves-effect waves-light btn tooltipped red right" data-delay="50" data-tooltip="Delete Opleiding"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
        </div>
        <div class="popup centered hidden">
            <i class="popup-exit small material-icons right">cancel</i>
            <div class="row">
                <h4>Opleiding toevoegen</h4>
            </div>
            <form action="index.php?page=opleidingen" method="POST">
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" accept=".csv">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <button class="btn waves-effect waves-light popup-submit" type="submit" name="action">Opleiding toevoegen
                        <i class="material-icons right">send</i>
                    </button>
                </div>

            </form>
        </div>
        <?php
        }

        function showMessagesPage(){
        // todo don't show add button for students
        // todo only show messages that are relevant for the user
        $userDAO = new UserDAO();
        $messages = $userDAO->getAllMessages();
        ?>
        <div class="row">
            <h2>Meldingen</h2>
        </div>
        <div class="row">
            <a class="btn-floating btn-large waves-effect waves-light tooltipped openPopup" data-delay="50" data-tooltip="Melding Toevoegen"><i class="material-icons">add</i></a>
            <ul class="collapsible popout col s8 offset-s1" data-collapsible="expandable">

                <?php
                foreach($messages as $melding) {
                $teacher = $userDAO->getTeacherById($melding->teacherId);
                ?>
                <li>
                    <div class="collapsible-header
<?php
                    // todo not hardcode this 'active'-class
                    if($melding->id == 3) echo "active\"><i class=\"material-icons\">sms_failed</i>";
                    else echo "\"><i class=\"material-icons\">navigate_next</i>";
                    ?>
            <?= $melding->titel ?> (geplaatst door <?=$teacher->firstname?> <?=$teacher->lastname?> op <?=$melding->datum?>)

            </div>
            <div class="collapsible-body">
            <span>
                <?=$melding->tekst?>
            </span>
                    <div class="row">
                        <a class="waves-effect waves-light btn tooltipped red right" data-delay="50" data-tooltip="Delete melding"><i class="material-icons">delete</i></a>
                    </div>
        </div>
        </li>
        <?php
        }
        ?>
        </ul>
    </div>
    <div class="popup centered hidden">
        <i class="popup-exit small material-icons right">cancel</i>
        <div class="row">
            <h4>Melding toevoegen</h4>
        </div>
        <div class="col 9">
            <form action="index.php?page=meldingen" method="POST">
                <div class="row">
                    <div class="input-field">
                        <input id="message-subject" name="message-subject" type="text">
                        <label for="message-subject">Onderwerp</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <textarea id="message" class="materialize-textarea"></textarea>
                        <label for="message">Melding</label>
                    </div>
                </div>

                <div class="row">
                    <p style="color: #9e9e9e">Zichtbaar voor:</p>
                    <form class=""  action="#" id="">
                        <?php
                        showEducationsCheckboxes(false);
                        ?>
                    </form>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light popup-submit" type="submit" name="action">Melding toevoegen
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>

        <?php
        }

        function showPrintPage(){
            $userDAO = new UserDAO();
            // TODO checkbox functionality on this page (javascript)
            ?>
            <div class="row">
                <h2>Rapporten afdrukken</h2>
            </div>
            <div class="row">
                <p style="color: #9e9e9e">Selecteer opleidingen</p>
                <?php
                $educationIds = showEducationsCheckboxes(true);
                ?>

                <form class="col s7" action="#">
                    <p>
                        <input type="checkbox" id="more-checkboxes" checked="checked" />
                        <label for="more-checkboxes">Alles selecteren</label>
                    </p>
                    <table class="striped bordered">
                        <tr><th>Student</th></tr>
                        <?php
                        foreach($educationIds as $educationId) {
                            $students = $userDAO->getAllStudentsInEducation($educationId);
                            //TODO show correct students when education is selected
                            foreach ($students as $student) {
                                ?>
                                <tr data-opleidingId="<?=$educationId?>">
                                    <td>
                                        <p class="opleiding-checkbox " style="display:inline-block">
                                            <input type="checkbox" id="student-checkbox<?= $student->id ?>" checked="checked"/>
                                            <label
                                                for="student-checkbox<?= $student->id ?>"><?= $student->firstname ?> <?= $student->lastname ?>(<?= $student->email ?>)</label>
                                        </p>
                                        <a class="waves-effect waves-light btn tooltipped right" data-delay="50"
                                           data-tooltip="Rapport bekijken"><i class="material-icons right">import_contacts</i>Rapport</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </form>
                <div class="right-align col s2 reports-btns">
                    <a class="waves-effect waves-light btn tooltipped" style="margin-bottom: 5px" data-delay="50" data-tooltip="Rapporten downloaden"><i class="material-icons">file_download</i></a>
                    <a class="waves-effect waves-light btn tooltipped" style="margin-bottom: 5px" data-delay="50" data-tooltip="Rapporten afdrukken"><i class="material-icons">print</i></a>
                </div>
            </div>
            <?php
        }
        function ShowStudentAddPage(){
            $userDAO = new UserDAO();
            $opleidingen = $userDAO->getAllEducations();
            ?>
            <div class="row">
                <h2>Student toevoegen</h2>
            </div>
            <form action="index.php?page=editStudentModules" method="POST">
                <div class="row">
                    <div class="input-field">
                        <input id="student-name" name="student-name" type="text" required>
                        <label for="student-name">Naam</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input id="student-firstname" name="student-firstname" type="text" required>
                        <label for="student-firstname">Voornaam</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input id="student-email" name="student-email" type="text" required>
                        <label for="student-email">Email</label>
                    </div>
                </div>
                <div class="row ">
                    <label>Selecteer een opleiding</label>
                    <select name="student-opleidingId" required>
                        <option value="" disabled selected>Geen selectie</option>
                        <?php
                        foreach($opleidingen as $opleiding){
                            ?>
                            <option value="<?= $opleiding->id?>"> <?= $opleiding->name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light message-submit" type="submit" name="action">Sla op en wijs modules toe
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>

            <?php
        }
        function showStudentEditModulesPage($opleidingId, $studentId){
            $userDAO = new UserDAO();
            $user = $userDAO->getUserById($studentId);
            $modules = $userDAO->getModulesInOpleiding($opleidingId);
            $algemeneModules = $userDAO->getModulesInOpleiding(null);
            //$studentModules = $userDAO->getModulesFromStudent($studentId);
            // TODO compare with studentModules, check modules student is already in

            ?>
            <div class="row">
                <h2>Modules van <?=$user->firstname?> <?=$user->lastname?></h2>
            </div>
            <p>Selecteer de doelstellingen waarvoor de student zich inschrijft:</p>
            <form action="index.php?page=studenten" method="POST">
                <?php
                for($i = 0; $i <= 1; $i++){
                    if($i==0){
                        ?>
                        <h4>Modules in de opleiding <?= $userDAO->getEducation($opleidingId)->name ?></h4>
                        <?php
                    }
                    if($i==1) {
                        $modules = $algemeneModules;
                        ?>
                        <h4>Algemene modules</h4>
                        <?php
                    }
                    ?>
                    <div class="row">
                        <ul class="collapsible" data-collapsible="expandable">
                            <?php

                            foreach($modules as $module) {
                                ?>
                                <li>
                                    <div class="collapsible-header collapsible-module active"><i class="collapse-icon material-icons">indeterminate_check_box</i><?= $module->name ?></div>
                                    <div class="collapsible-body">
                            <span>
                                <table class="striped bordered">
                                    <tr>
                                        <?php
                                        $doelstellingen = $userDAO->getDoelstellingenInModule($module->id);
                                        if($doelstellingen != null) foreach($doelstellingen as $doelstelling) {
                                        ?>
                                        <!-- TODO make checkboxes work (submitting this) -->
                                        <th><input type="checkbox" label="doelstelling<?=$doelstelling->id?>-checkbox" /><label for="doelstelling<?=$doelstelling->id?>-checkbox"><?= $doelstelling->name ?></label></th>
                                        <?php
                                        $criteria = $userDAO->getCriteriaForDoelstelling($doelstelling->id);
                                        foreach($criteria as $criterium) {
                                        ?>
                                    </tr><tr><td class="valign-wrapper"><i class="material-icons">navigate_next</i><?= $criterium->weergaveTitel?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr><tr>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </span>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <button class="btn waves-effect waves-light message-submit" type="submit" name="action">Student opslaan
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
            <?php
        }

        function showOpleidingAddPage()
        {
            ?>
            <div class="row">
                <h2>Opleiding toevoegen</h2>
            </div>
            <form action="index.php?page=addModuleToOpleiding" method="POST">
                <div class="input-field">
                    <label for="opleiding-name">Naam opleiding</label>
                    <input id="opleiding-name" name="opleiding-name" type="text" required/>
                </div>
                <div class="row">
                    <button class="right btn waves-effect waves-light opleiding-submit" type="submit"><i class='material-icons right'>send</i>Opleiding opslaan en nieuwe module aanmaken</button>
                </div>
            </form>
            <?php
        }

        function showAddModuleToOpleidingPage($opleidingName) // TODO change parameter to opleidingId (or opleiding-object)
        {
            $userDAO = new UserDAO();
            $opleidingen = $userDAO->getAllEducations();
            ?>

            <div class="row">
                <h2>Nieuwe module aanmaken voor opleiding <?= $opleidingName ?></h2>
            </div>
            <form method="POST">
                <div class="row courseCreator">
                    <div class='row'>
                        <div class='input-field module-input'>
                            <input type="hidden" name="opleiding-name" value="<?=$opleidingName?>" />
                            <label for='module-name'>Modulenaam</label>
                            <input name='module-name' type='text' />
                        </div>
                        <div class='creator-btns'>
                            <a class='add-doelstelling-btn waves-effect waves-light btn'><i class='material-icons left'>add</i>Doelstelling toevoegen</a>
                        </div>
                    </div>
                    <div>
                        <table class='striped bordered doelstelling-table'>
                            <p class='no-doelstellingen'>Geen doelstellingen</p>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <button class="right btn waves-effect waves-light addModule" data-stopAddingModules="false" type="submit"><i class='material-icons right'>send</i>Opslaan en nieuwe module toevoegen</button>
                </div>
                <div class="row">
                    <button class="right btn waves-effect waves-light addModule" data-stopAddingModules="true"><i class='material-icons right'>send</i>Opslaan en stoppen</button>
                </div>
            </form>
            <?php
        }
        ?>
