<?php

session_start();
require_once("constants.php");
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
              <label for="<?=FIELD_NAME_COACH?>"><?=EXPECTED_FIELDS[FIELD_NAME_COACH]?></label>
              <select id="<?=FIELD_NAME_COACH?>" name="<?=FIELD_NAME_COACH?>" size="1">
                <?php foreach(Coach::loadAllCoaches() as $coach) { ?>
                  <option value="<?=$coach->id?>"<?php echoSelectedIfInSession(FIELD_NAME_COACH, $coach->id); ?>><?=$coach->name?></option>
                <?php } ?>
              </select>
            </div>

            <div class="formRow">
              <label for="<?=FIELD_NAME_GROUP?>"><?=EXPECTED_FIELDS[FIELD_NAME_GROUP]?></label>
              <select id="<?=FIELD_NAME_GROUP?>" name="<?=FIELD_NAME_GROUP?>" size="1">
                <?php foreach(Group::loadAllGroups() as $group) { ?>
                    <option value="<?=$group->id?>"<?php echoSelectedIfInSession(FIELD_NAME_GROUP, $group->id); ?>><?=$group->name?></option>
                <?php } ?>
              </select>
            </div>

            <div class="formRow">
              <label for="<?=FIELD_NAME_TRAININGDATE?>"><?=EXPECTED_FIELDS[FIELD_NAME_TRAININGDATE]?></label>
              <input type="date" id="<?=FIELD_NAME_TRAININGDATE?>" name="<?=FIELD_NAME_TRAININGDATE?>" value="<?php echoIfInSession(FIELD_NAME_TRAININGDATE); ?>">
            </div>

            <div class="formRow">
              <label for="femaleUnder18"><?=EXPECTED_FIELDS[FIELD_NAME_FEMALE_UNDER]?></label>
              <input type="number" id="<?=FIELD_NAME_FEMALE_UNDER?>" name="<?=FIELD_NAME_FEMALE_UNDER?>" min="0" step="1" value="<?php echoIfInSession(FIELD_NAME_FEMALE_UNDER); ?>">
            </div>

            <div class="formRow">
              <label for="femaleUnder18"><?=EXPECTED_FIELDS[FIELD_NAME_MALE_UNDER]?></label>
              <input type="number" id="<?=FIELD_NAME_MALE_UNDER?>" name="<?=FIELD_NAME_MALE_UNDER?>" min="0" step="1" value="<?php echoIfInSession(FIELD_NAME_MALE_UNDER); ?>">
            </div>

            <div class="formRow">
              <label for="femaleUnder18"><?=EXPECTED_FIELDS[FIELD_NAME_FEMALE_OVER]?></label>
              <input type="number" id="<?=FIELD_NAME_FEMALE_OVER?>" name="<?=FIELD_NAME_FEMALE_OVER?>" min="0" step="1" value="<?php echoIfInSession(FIELD_NAME_FEMALE_OVER); ?>">
            </div>

            <div class="formRow">
              <label for="femaleUnder18"><?=EXPECTED_FIELDS[FIELD_NAME_MALE_OVER]?></label>
              <input type="number" id="<?=FIELD_NAME_MALE_OVER?>" name="<?=FIELD_NAME_MALE_OVER?>" min="0" step="1" value="<?php echoIfInSession(FIELD_NAME_MALE_OVER); ?>">
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
