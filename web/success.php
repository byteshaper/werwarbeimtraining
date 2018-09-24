<?php

session_start();
require_once("constants.php");
require_once("ParticipantCounts.php");
require_once("useragentstats.php");

$participantCounts = new ParticipantCounts(
    $_SESSION[FIELD_NAME_GROUP],
    $_SESSION[FIELD_NAME_TRAININGDATE],
    $_SESSION[FIELD_NAME_COACH],
    $_SESSION[FIELD_NAME_FEMALE_UNDER],
    $_SESSION[FIELD_NAME_MALE_UNDER],
    $_SESSION[FIELD_NAME_FEMALE_OVER],
    $_SESSION[FIELD_NAME_MALE_OVER]);

try {
  $participantCounts->save();
  unset($_SESSION['formValidationError']);

  foreach (array_keys(EXPECTED_FIELDS) as $fieldName) {
    unset($_SESSION[$fieldName]);
  }
} catch(Exception $e) {
  backToInputWithError("Fehler beim Speichern: " . $e->getMessage());
}

try {
  saveUserAgentStats();
} catch(Exception $e) {
  // nothing to do
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
          <h1>Eingaben gespeichert</h1>
          <p>
            Vielen Dank für Deine Eingaben, sie wurden erfolgreich gespeichert! <br>
            Falls Du weitere Daten eingeben möchtest, klicke bitte <a href="index.php">hier</a>.
          </p>
        </header>


    </body>
</html>
