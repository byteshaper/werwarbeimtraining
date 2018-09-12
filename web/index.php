<?php

session_start();
require_once("Group.php");
require_once("Coach.php");

function echoIfInSession($fieldName) {
  if(isset($_SESSION[$fieldName])) {
    echo $_SESSION[$fieldName];
  }
}

function echoSelectedIfInSession($fieldName, $id) {
  if(isset($_SESSION[$fieldName]) && $_SESSION[$fieldName] == $id) {
    echo " selected";
  } else {
    echo "";
  }
}


 ?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="stylisherstyle.css">
        <title>BSV Kreuzberg e.V. - Eingabe der Teilnehmerzahlen Deiner Trainingsgruppe</title>
    <head>
    <body>
        <header>
          <h1>Eingabe der Teilnehmer&shy;zahlen</h1>
          <p class="text-justify">
            Bitte gib hier ein, wieviele Personen bei Deiner Trainingsgruppe anwesend waren,
            aufgeteilt nach Geschlecht und nach Altersgruppe (Unter-18 / Über-18).
          </p>
          <small>Falls von einer Altersgruppe / einem Geschlecht niemand da war, gibt bitte eine "0" ein.</small>
        </header>

        <form action="submit.php" method="post">

            <div class="formRow">
              <label for="coach">Trainer*in</label>

              <select id="coach" name="coachId" size="1">
                <?php foreach(Coach::loadAllCoaches() as $coach) { ?>
                  <option value="<?=$coach->id?>"<?php echoSelectedIfInSession("coachId", $coach->id); ?>><?=$coach->name?></option>
                <?php } ?>
              </select>
            </div>

            <div class="formRow">
              <label for="group">Gruppe</label>
              <select id="group" name="groupId" size="1">
                <?php foreach(Group::loadAllGroups() as $group) { ?>
                    <option value="<?=$group->id?>"<?php echoSelectedIfInSession("groupId", $group->id); ?>><?=$group->name?></option>
                <?php } ?>
              </select>
            </div>

            <div class="formRow">
              <label for="trainingDate">Trainingsdatum</label>
              <input type="date" id="trainingDate" name="trainingDate" value="<?php echoIfInSession("trainingDate"); ?>">
            </div>

            <div class="formRow">
              <label for="femaleUnder18">Schwimmer<strong>innen unter</strong> 18</label>
              <input type="number" id="femaleUnder18" name="femaleUnder18" min="0" step="1" value="<?php echoIfInSession("femaleUnder18"); ?>">
            </div>

            <div class="formRow">
              <label for="maleUnder18">Schwimm<strong>er unter</strong> 18</label>
              <input type="number" id="maleUnder18" name="maleUnder18" min="0" step="1" value="<?php echoIfInSession("maleUnder18"); ?>">
            </div>

            <div class="formRow">
              <label for="femaleOver18">Schwimmer<strong>innen über</strong> 18</label>
              <input type="number" id="femaleOver18" name="femaleOver18" min="0" step="1" value="<?php echoIfInSession("femaleOver18"); ?>">
            </div>

            <div class="formRow">
              <label for="maleOver18">Schwimm<strong>er über</strong> 18</label>
              <input type="number" id="maleOver18" name="maleOver18" min="0" step="1" value="<?php echoIfInSession("maleOver18"); ?>">
            </div>

            <div class="formRow">
              <input id="saveButton" type="submit" value="Speichern">
            </div>

        <form>

        <?php if(isset($_SESSION['formValidationError'])) { ?>
            <div id="formValidationError">
              <strong>Fehler: </strong><?=$_SESSION['formValidationError']?>
            </div>

        <?php } ?>
    </body>
</html>
