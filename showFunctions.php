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
        <form action="index.php" method="POST">
          <div class="row">
            <div class="input-field">
              <input id="username" name="username" type="text" class="validate">
              <label for="username">Gebruikersnaam</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field">
              <input id="password" name="password" type="password" class="validate">
              <label for="password">Wachtwoord</label>
            </div>
          </div>
          <div class="g-recaptcha" data-sitekey="6LepDTQUAAAAAJQCkfOXuM_mxjH7wsgXfKYbPNKy"></div>
          <button class="btn waves-effect waves-light" type="submit" name="action">Log in
            <i class="material-icons right">send</i>
          </button>
        </form>
    </div>
<?php
}

function showNavigation($name){
    ?>
    <header>

    <nav>
        <div class="nav-wrapper nav-color">
            <ul class="right hide-on-med-and-down">
                <li><a class="dropdown-button" href="#!" data-activates="userDropdown"><?php echo $name ?><i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button" href="#!" data-activates="stateDropdown">Admin<i class="material-icons right">arrow_drop_down</i></a></li>
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

    <ul id="stateDropdown" class="dropdown-content">
        <li><a href="#!">Admin</a></li>
        <li class="divider"></li>
        <li><a href="#!">Leerkracht</a></li>
        <li class="divider"></li>
        <li><a href="#!">Student</a></li>
    </ul>
</header>

<ul id="slide-out" class="side-nav">
    <img src="images/CLW_Logo.png" class="school-logo"/>
    <li><div class="divider"></div></li>
    <li><a class="waves-effect" href="index.php?page=rapporten">Rapporten</a></li>
    <li><a class="waves-effect" href="index.php?page=studenten">Studenten</a></li>
    <li><a class="waves-effect" href="index.php?page=richtingen">Richtingen</a></li>
    <li><a class="waves-effect" href="index.php?page=meldingen">Meldingen</a></li>
    <li><a class="waves-effect" href="#!">Afdrukken</a></li>
</ul>

<main class="container">
<?php
}

function showStart(){
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
?>
    <h2>Mijn account</h2>
    <table class="striped">
        <tr><td>Voornaam: <span>John</span></td></tr>
        <tr><td>Familienaam: <span>Doe</span></td></tr>
        <tr><td>Email: <span>John.Doe@clw.be</span></td></tr>
        <tr><td>Lid sinds: <span>09/10/2017 17:33:15</span></td></tr>
    </table>
<?php
}

function showReportsPage(){
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
                <td contenteditable="false">Resultaat</td>
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
        <div class="right-align col s6 student-btn">
            <a class="btn-floating btn-large waves-effect waves-light tooltipped" data-delay="50" data-tooltip="Student Toevoegen"><i class="material-icons">add</i></a>
        </div>
    </div>
    <div class="row">
    <form class="col s3" action="#">
        <p>
            <input type="checkbox" id="all-checkboxes" checked="checked" />
            <label for="all-checkboxes">Alles selecteren</label>
        </p>

<?php
        for($richtingen = 10; $richtingen > 0; $richtingen--){
?>
            <p class="richting-checkbox">
                <input type="checkbox" id="richting<?php echo $richtingen?>" checked="checked" />
                <label for="richting<?php echo $richtingen?>">richting<?php echo $richtingen?></label>
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
<?php
}

function showSubjectPage(){
    ?>
    <div class="row">
        <h2>Richtingen</h2>
    </div>
    <div class="row">
        <div class="subject-search input-field col s6">
            <input type="text" id="subject-search" class="col s8" name="subject-search">
            <label for="subject-search">Zoek Richting</label>
            <a class="waves-effect waves-light btn"><i class="material-icons">search</i></a>
        </div>
        <div class="right-align col s6 subject-btn">
            <a class="btn-floating btn-large waves-effect waves-light tooltipped" data-delay="50" data-tooltip="Richting Toevoegen"><i class="material-icons">add</i></a>
        </div>
    </div>
    <div class="row">
        <table class="striped bordered">
            <tr>
                <th>Richting</th>
                <th width="200px">Acties</th>
            </tr>
            <?php
            for($richting = 10; $richting > 0;$richting--){
                ?>
                <tr>
                    <td>Richting<?php echo $richting?></td>
                    <td>
                        <a class="waves-effect waves-light btn tooltipped" data-delay="50" data-tooltip="Modules aanpassen"><i class="material-icons">edit</i></a>
                        <a class="waves-effect waves-light btn tooltipped red right" data-delay="50" data-tooltip="Delete Richting"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
                <?php
            }
            ?>
    </div>
    <?php
}

function showMessagesPage(){
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
            <div class="collapsible-body"><span>        Nulla lobortis aliquam placerat. Quisque at justo maximus, commodo diam sit amet, feugiat arcu. Mauris non suscipit ex, vitae tincidunt magna.
        Etiam neque sem, euismod ac odio vel, rhoncus interdum mauris. Morbi aliquet sollicitudin nisl, sit amet tempus lorem interdum sit amet.
        Nam sagittis tempus mattis. Etiam mattis eros eget eros vulputate, quis vestibulum lorem convallis. Suspendisse quis sollicitudin enim.
        Nulla metus dolor, venenatis ut lacus ut, dictum interdum ante. Sed suscipit mi at ante vulputate, quis maximus elit tempor.
        Nullam elementum venenatis commodo. Etiam vel tristique massa. Etiam libero mauris, posuere sed massa nec, tristique vehicula lacus.
        Donec lacinia, lorem et mattis tincidunt, lectus metus imperdiet mi, in tempor turpis lectus id lacus..</span></div>
        </li>
<?php
    }
?>
        </ul>
        </div>
        <div class="addMessage-popup centered hidden">
            <i class="message-exit small material-icons right">cancel</i>
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
            <div class="row">
              <label>Zichtbaar voor:</label>
              <select class="browser-default">
                <option value="0" selected>Iedereen</option>
<?php
                for($richtingen = 10; $richtingen > 0; $richtingen--){
?>
                <option value="1">Richting<?php echo $richtingen?></option>
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
?>
