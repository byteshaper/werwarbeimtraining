<?php

session_start();
require_once("constants.php");
require_once("Coach.php");
require_once("Group.php");

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
          <h1>Überprüfen Deiner Eingaben</h1>
          <p class="text-justify">
            Bitte überprüf nochmal ob alle Daten stimmen. Wenn ja, klicke auf Speichern, andernfalls auf Zurück.
          </p>
        </header>

        <table>
          <?php foreach(array_keys(EXPECTED_FIELDS) as $fieldName) {?>
            <tr>
              <td class="tableCellLabel"><?=EXPECTED_FIELDS[$fieldName]?></td>
              <td class="tableCellValue">
                <?php
                  if($fieldName == FIELD_NAME_COACH) {
                    echo Coach::loadCoachNameById($_SESSION[$fieldName]);
                  } else if($fieldName == FIELD_NAME_GROUP) {
                    echo Group::loadGroupNameById($_SESSION[$fieldName]);
                  } else {
                    echo $_SESSION[$fieldName];
                  }
                ?>
              </td>
            </tr>
          <?php } ?>
        </table>

        <div class="buttonBar">
          <div id="saveButtonLink">
            <a href="success.php">Speichern</a>
          </div>
          <div id="backButtonLink">
            <a href="index.php">Zurück</a>
          </div>
        </div>

    </body>
</html>
