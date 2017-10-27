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
        <form action="verify.php" method="POST">
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
            <div class="row">
                <div class="g-recaptcha" id="captcha" data-sitekey="6LepDTQUAAAAAJQCkfOXuM_mxjH7wsgXfKYbPNKy"></div>
            </div>
          <button class="btn waves-effect waves-light" type="submit" name="action">Log in
            <i class="material-icons right">send</i>
          </button>
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
                <li><a class="dropdown-button" href="#!" data-activates="userDropdown"><?php echo $name ?><i class="material-icons right">arrow_drop_down</i></a></li>
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
        <li><a href="index.php?page=afmelden">Afmelden</a></li>
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
        <tr><td>Voornaam: <span><?php echo $user->firstname ?></span></td></tr>
        <tr><td>Familienaam: <span><?php echo $user->lastname ?></span></td></tr>
        <tr><td>Email: <span><?php echo $user->email ?></span></td></tr>
        <tr><td>Lid sinds: <span><?php echo $user->accountCreatedTimestamp ?></span></td></tr>
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
                        <input id="account-FirstName" name="account-FirstName" type="text">
                        <label for="account-FirstName">Voornaam</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input id="account-LastName" name="account-LastName" type="text">
                        <label for="account-LastName">Naam</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input id="student-email" name="student-email" type="text">
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
        <p>Studiemodules van: <span style="font-weight: bold">Faisal Nizami</span></p>
    </div>
    <div class="row">
        <div class="modules-progress col s11">
            <span><span>1</span>/4 modules geslaagd</span>
            <div class="progress">
                <div class="determinate" style="width: 25%"></div>
            </div>
        </div>

        <div class="right-align">
            <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Aanpassen inschakelen"><i class="material-icons">edit</i></a>
        </div>
    </div>
    <ul class="popout collapsible courseCreator" data-collapsible="expandable">
<?php
    // todo get students results and comments from database
    foreach($modules as $module){
?>

    <li>
    <div class='valign-wrapper collapsible-header collapsible-module active'><i class='collapse-icon material-icons'>indeterminate_check_box</i>
    <h4><?= $module->name ?></h4>
    </div>
    <div class='collapsible-body'>
        <table class="striped bordered">
            <tr>
                <th>Doelstellingen</th>
                <th>Resultaat</th>
                <th>Datum (dd/mm/yyyy)</th>
                <th>Opmerkingen</th>
            </tr>
            <tr>

<?php
    $doelstellingen = $userDAO->getFollowedDoelstellingenInModule($module->id, $studentId);
        foreach($doelstellingen as $doelstelling){
?>
            <th style="border-top: 2px solid gray; border-bottom: 2px solid gray" colspan="4"><strong><?= $doelstelling->name ?></strong></th>
            </tr><tr>
<?php
    $criteria = $userDAO->getCriteriaForDoelstelling($doelstelling->id);
            foreach($criteria as $criterium){
?>
                <td style="padding-left: 30px" class="valign-wrapper"><i class="material-icons">navigate_next</i><?= $criterium->weergaveTitel ?></td>
                <td contenteditable="false">
                  <div class="input-field">
                    <select disabled>
                      <option value="" disabled selected>Niets geselecteerd</option>
                      <option value="1">Option 1</option>
                      <option value="2">Option 2</option>
                      <option value="3">Option 3</option>
                    </select>
                  </div>
                </td>
                <td contenteditable="false">00/00/0000</td>
                <td contenteditable="false">Opmerking</td>
                </tr><tr>
<?php
            }

        }
?>
            </tr>
        </table>

        <p>Commentaar bij deze module: </p>
        <p>Etiam quis accumsan leo, id gravida urna. Duis ac velit quis risus egestas ornare non eu tortor. Pellentesque habitant
            morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam molestie tincidunt diam, id suscipit
            nisi cursus sit amet. Aliquam in nisi eget erat laoreet feugiat. Pellentesque non tellus augue. Fusce ante neque,
            consectetur at tincidunt ac, iaculis quis ante. Suspendisse potenti. Nam tempus nisi eu erat facilisis tempus. Vestibulum
            ultricies, diam vitae laoreet congue, ipsum elit tempor diam, nec gravida lacus mi nec ligula. Duis posuere lacinia magna a
            venenatis. Ut feugiat a velit a malesuada. Ut odio sem, lacinia ac metus nec, sollicitudin efficitur erat.
        </p>
    </div>
    </li>
<?php
    }
?>
    </ul>
    <p>Algemeen commentaar:</p>
    <p>Cras non urna tellus. Nunc eu aliquam sem, eget ultrices ligula. Pellentesque convallis odio nec neque egestas volutpat. Aliquam
        venenatis augue quis est blandit pretium. Aliquam fringilla tortor at turpis venenatis hendrerit. Vestibulum auctor, est nec
        elementum tempus, sem purus malesuada arcu, at molestie massa justo sed risus. Cras laoreet accumsan erat ac elementum. Fusce
        tristique egestas orci, a vehicula lorem tristique blandit. Aenean et congue purus.</p>
    <br />
    <p>Commentaar klassenraad:</p>
    <p>Suspendisse sem neque, consequat nec ultricies at, maximus sit amet ante. Nunc rhoncus gravida molestie. Vestibulum ante
        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus nibh eros, ornare eu mattis in, gravida
        ac massa. Praesent placerat lacinia pulvinar. Aenean interdum metus ac neque aliquet, gravida pellentesque mauris congue.
        Quisque commodo a libero non venenatis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
        Mauris sit amet ante vitae nisl vulputate tempor. Donec feugiat orci lectus, bibendum condimentum neque ultrices et. Praesent
        ac leo sit amet libero tempor dignissim. Aliquam vehicula augue vel ante ullamcorper ornare. Sed est turpis, luctus et neque et,
        pellentesque finibus tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
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
        <div class="right-align col s6 subject-btn">
            <a class="btn-floating btn-large waves-effect waves-light tooltipped" href="index.php?page=editOpleiding" data-delay="50" data-tooltip="Opleiding Toevoegen"><i class="material-icons">add</i></a>
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
                                    for="student-checkbox<?= $student->id ?>"><?= $student->firstname ?> <?= $student->lastname ?> (<?= $student->email ?>)</label>
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
function showStudentEditPage(){
?>
    <div class="row">
        <h2>Student aanpassen</h2>
    </div>
    <form action="index.php?page=studenten" method="POST">
        <div class="row">
            <div class="input-field">
                <input id="student-name" name="student-name" type="text">
                <label for="student-name">Naam</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field">
                <input id="student-firstname" name="student-firstname" type="text">
                <label for="student-firstname">Voornaam</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field">
                <input id="student-email" name="student-email" type="text">
                <label for="student-email">Email</label>
            </div>
        </div>
        <div class="row ">
            <label>Selecteer een richting</label>
            <select>
                <option value="0" disabled selected>Geen selectie</option>
<?php
                for($opleidingen = 10; $opleidingen > 0; $opleidingen--){
?>
                    <option value="<?php echo $opleidingen?>">Opleiding<?php echo $opleidingen?></option>
<?php
                }
?>
            </select>
        </div>
        <div class="row">
            <ul class="collapsible" data-collapsible="expandable">
<?php
                for($modules = 3; $modules > 0; $modules--) {
?>
                    <li>
                        <div class="collapsible-header collapsible-module active"><i class="collapse-icon material-icons">indeterminate_check_box</i>Module<?php echo $modules ?></div>
                        <div class="collapsible-body">
                            <span>
                                <table class="striped bordered">
                                    <tr>
<?php
                                    for($doelstellingen = 3; $doelstellingen > 0; $doelstellingen--) {
?>
                                            <th>Doelstelling<?php echo $doelstellingen ?></th>
<?php
                                            for($criteria = 3; $criteria > 0; $criteria--) {
?>
                                                </tr><tr><td class="valign-wrapper"><i class="material-icons">navigate_next</i>Criteria<?php echo $criteria?></td>
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
        <div class="row">
            <button class="btn waves-effect waves-light message-submit" type="submit" name="action">Student opslaan
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
<?php
}

function showOpleidingAddPage(){
?>
    <div class="row">
        <h2>Opleiding toevoegen</h2>
    </div>
    <form action="index.php?page=opleidingen" method="POST">
            <div class="input-field">
                <label for="opleiding-name">Naam opleiding</label>
                <input id="opleiding-name" name="opleiding-name" type="text" required />
            </div>
        </div>
        <div class="row">
            <ul class="popout collapsible courseCreator" data-collapsible="expandable">

            </ul>
        </div>
        <div class="row addModule-row">
            <button class="btn waves-effect waves-light addModule">Opleidingsspecifieke module toevoegen</button>
        </div>
        <div class="row">
            <button class="right btn waves-effect waves-light opleiding-submit" type="submit"><i class='material-icons right'>send</i>Opleiding opslaan</button>
        </div>
    </form>
<?php
}
?>
