<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 9/10/2017
 * Time: 9:52
 */

function showLogin(){
?>
    <div class="login centered z-depth-5">
        <form action="verify.php" method="POST">
          <div class="row">
            <div class="input-field">
              <input id="username" name="username" type="text" class="validate">
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

function showAccount(){
    // todo get actual user data from db
?>
    <h2>Mijn account</h2>
    <table class="striped">
        <tr><td>Voornaam: <span>John</span></td></tr>
        <tr><td>Familienaam: <span>Doe</span></td></tr>
        <tr><td>Email: <span>John.Doe@clw.be</span></td></tr>
        <tr><td>Lid sinds: <span>09/10/2017 17:33:15</span></td></tr>
    </table>
    <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Account wijzigen"><i class="material-icons">edit</i></a>
<?php
}

function showReportsPage(){
    // todo get actual data from db ... a lot of data + don't show edit report button for students, that'd be weird  ;) (aslo show ONLY his report)
?>
    <div class="row">
        <h2>Rapporten</h2>
    </div>
    <div class="row">
        <div class="student-search input-field col s6">
          <input type="text" id="report-search" class="col s8" name="report-search">
          <label for="report-search">Zoek student</label>
          <a class="waves-effect waves-light btn"><i class="material-icons">search</i></a>
        </div>
        <div class="right-align col s6 reports-btns">
            <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Rapport downloaden"><i class="material-icons">file_download</i></a>
            <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Rapport afdrukken"><i class="material-icons">print</i></a>
        </div>
    </div>
    <div class="row">
        <p>Studiefiches van: <span style="font-weight: bold">Studentennaam</span></p>
    </div>
    <div class="row">
        <div class="fiches-progress col s11">
            <span><span>1</span>/4 fiches geslaagd</span>
            <div class="progress">
                <div class="determinate" style="width: 25%"></div>
            </div>
        </div>

        <div class="right-align">
            <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Aanpassen inschakelen"><i class="material-icons">edit</i></a>
        </div>
    </div>
    <table class="striped bordered">
        <tr>
            <th>Fiche</th>
            <th>Module</th>
            <th>Resultaat</th>
            <th>Datum (dd/mm/yyyy)</th>
            <th>Opmerkingen</th>
        </tr>
        <tr>
<?php
    for($fiches = 5; $fiches > 0; $fiches--){
/* rowspan here is modules * criteria + modules */?>
        <td rowspan="15">Fiche<?php echo $fiches?></td>
<?php
        for($modules= 3; $modules > 0; $modules--){
?>
            <td colspan="4">Module<?php echo $modules?></td>
            </tr><tr>
<?php
            for($criteria = 4; $criteria > 0;$criteria--){
?>
                <td class="valign-wrapper"><i class="material-icons">navigate_next</i>Criteria<?php echo $criteria?></td>
                <td contenteditable="false">
                  <div class="input-field">
                    <select disabled>
                      <option value="" disabled selected>Niets geselecteerd</option>
                      <option value="1">Option 1</option>
                      <option value="2">Option 2</option>
                      <option value="3">Option 3</option>
                    </select>
                    <label>Resultaat</label>
                  </div>
                </td>
                <td contenteditable="false">00/00/0000</td>
                <td contenteditable="false">Opmerking</td>
                </tr><tr>
<?php
            }

        }

    }
?>
        </tr>
    </table>
<?php
}

function showStudentsPage(){
    // todo get actual data from db
?>
    <div class="row">
        <h2>Studenten</h2>
    </div>
    <div class="row">
        <div class="student-search input-field col s6">
            <input type="text" id="student-search" class="col s8" name="student-search">
            <label for="student-search">Zoek student</label>
            <a class="waves-effect waves-light btn"><i class="material-icons">search</i></a>
        </div>
        <div class="row">
            <div class="addstudent" style="position: relative; height: 90px;">
            <div class="fixed-action-btn horizontal" style="position: absolute; display: inline-block; right: 24px;">
                <a class="btn-floating btn-large tooltipped" data-position="top" data-delay="50" data-tooltip="Student Toevoegen">
                    <i class="large material-icons">add</i>
                </a>
                <ul>
                    <li><a href="index.php?page=editStudent" class="btn-floating red tooltipped" data-position="top" data-delay="50" data-tooltip="Enkele student toevoegen"><i class="material-icons">person_add</i></a></li>
                    <li><a class="btn-floating yellow darken-1 tooltipped csv-upload" data-delay="50" data-tooltip=".csv uploaden"><i class="material-icons">file_upload</i></a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
    <form class="col s3" action="#">
        <p>
            <input type="checkbox" id="all-checkboxes" checked="checked" />
            <label for="all-checkboxes">Alles selecteren</label>
        </p>

<?php
        for($opleidingen = 10; $opleidingen > 0; $opleidingen--){
?>
            <p class="opleiding-checkbox">
                <input type="checkbox" id="opleiding<?php echo $opleidingen?>" checked="checked" />
                <label for="opleiding<?php echo $opleidingen?>">opleiding<?php echo $opleidingen?></label>
            </p>
<?php
        }
?>
    </form>
    <table class="col s9 striped bordered">
        <tr>
            <th>Student</th>
            <th>Acties</th>
        </tr>
<?php
            for($students = 30; $students > 0;$students--){
?>
            <tr>
                <td>Student<?php echo $students?></td>
                <td>
                    <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Rapport bekijken"><i class="material-icons right">import_contacts</i>Rapport</a>
                    <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Studiefiche aanpassen"><i class="material-icons">edit</i></a>
                    <a class="waves-effect waves-light btn tooltipped red right" data-delay="50" data-tooltip="Delete Student"><i class="material-icons">delete</i></a>
                </td>
            </tr>
<?php
            }
?>
    </div>
    <div class="csv-upload-popup centered hidden">
        <i class="popup-exit small material-icons right">cancel</i>
        <div class="row">
            <h4>Studenten toevoegen</h4>
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
              <button class="btn waves-effect waves-light csv-submit" type="submit" name="action">Studenten toevoegen
                <i class="material-icons right">send</i>
              </button>
            </div>

            </form>
        </div>
    </div>
<?php
}

function showSubjectPage(){
    // todo get actual data from db
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
            for($opleiding = 10; $opleiding > 0;$opleiding--){
                ?>
                <tr>
                    <td>Opleiding<?php echo $opleiding?></td>
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
        // todo get actual data from db + don't show add button for students

?>
        <div class="row">
            <h2>Meldingen</h2>
        </div>
        <div class="row">
            <a class="btn-floating btn-large waves-effect waves-light tooltipped addMessage" data-delay="50" data-tooltip="Melding Toevoegen"><i class="material-icons">add</i></a>
            <ul class="collapsible popout col s8 offset-s1" data-collapsible="expandable">

<?php
    for($meldingen = 3; $meldingen > 0;$meldingen--){
?>
        <li>
            <div class="collapsible-header
<?php
            if($meldingen === 3)
            {
                echo "active\"><i class=\"material-icons\">sms_failed</i>";
            }
            else{
                echo "\"><i class=\"material-icons \">navigate_next</i>";
            }
?>
            Melding
<?php
            echo $meldingen
?>
            </div>
            <div class="collapsible-body">
            <span>
            Nulla lobortis aliquam placerat. Quisque at justo maximus, commodo diam sit amet, feugiat arcu. Mauris non suscipit ex, vitae tincidunt magna.
            Etiam neque sem, euismod ac odio vel, rhoncus interdum mauris. Morbi aliquet sollicitudin nisl, sit amet tempus lorem interdum sit amet.
            Nam sagittis tempus mattis. Etiam mattis eros eget eros vulputate, quis vestibulum lorem convallis. Suspendisse quis sollicitudin enim.
            Nulla metus dolor, venenatis ut lacus ut, dictum interdum ante. Sed suscipit mi at ante vulputate, quis maximus elit tempor.
            Nullam elementum venenatis commodo. Etiam vel tristique massa. Etiam libero mauris, posuere sed massa nec, tristique vehicula lacus.
            Donec lacinia, lorem et mattis tincidunt, lectus metus imperdiet mi, in tempor turpis lectus id lacus..</span>
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
        <div class="addMessage-popup centered hidden">
            <i class="popup-exit small material-icons right">cancel</i>
            <div class="row">
                <h4>Melding toevoegen</h4>
            </div>
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
            <div class="row ">
              <label>Zichtbaar voor:</label>
              <select multiple>
                <option value="0" selected>Iedereen</option>
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
              <button class="btn waves-effect waves-light message-submit" type="submit" name="action">Melding toevoegen
                <i class="material-icons right">send</i>
              </button>
            </div>
            </form>
        </div>

<?php
}

function showPrintPage(){
?>
    <div class="row">
        <h2>Rapporten afdrukken</h2>
    </div>
    <div class="row">
            <label>Selecteer opleidingen</label>
            <select multiple>
            <option selected value="0">Alle opleidingen</option>
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
        <form class="col s10" action="#">
            <p>
                <input type="checkbox" id="all-checkboxes" checked="checked" />
                <label for="all-checkboxes">Alles selecteren</label>
            </p>
            <table class="striped bordered">
                <tr><th>Studenten</th></tr>
            <?php
            for($studenten = 10; $studenten > 0; $studenten--){
                ?>
                <tr>
                    <td>
                        <p class="opleiding-checkbox " style="display:inline-block">
                            <input type="checkbox" id="student-checkbox<?php echo $studenten?>" checked="checked" />
                            <label for="student-checkbox<?php echo $studenten?>">Student<?php echo $studenten?></label>
                        </p>
                        <a class="waves-effect waves-light btn tooltipped right"  data-delay="50" data-tooltip="Rapport bekijken"><i class="material-icons right">import_contacts</i>Rapport</a>
                    </td>
                </tr>
                <?php
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
                for($fiches = 3; $fiches > 0; $fiches--) {
?>
                    <li>
                        <div class="collapsible-header collapsible-fiche active"><i class="material-icons">indeterminate_check_box</i>Fiche<?php echo $fiches ?></div>
                        <div class="collapsible-body">
                            <span>
                                <table class="striped bordered">
                                    <tr>
<?php
                                    for($modules = 3; $modules > 0; $modules--) {
?>
                                            <th>Module<?php echo $modules ?></th>
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

function showOpleidingEditPage(){
?>
    <div class="row">
        <h2>Opleiding aanpassen</h2>
    </div>
<?php
}
?>
