<?php

session_start();

require_once("ParticipantCounts.php");
require_once("Coach.php");
require_once("Group.php");
require_once("useragentstats.php");

define("EXPECTED_FIELD_NAMES", array("trainingDate", "coachId", "groupId",  "femaleUnder18", "maleUnder18", "femaleOver18", "maleOver18"));

function backToInputWithError($errorMessage) {
  $_SESSION['formValidationError'] = $errorMessage;

  foreach (EXPECTED_FIELD_NAMES as $fieldName) {
    if(isset($_POST[$fieldName]) && $_POST[$fieldName] !== '') {
      $_SESSION[$fieldName] = $_POST[$fieldName];
    } else {
      unset($_SESSION[$fieldName]);
    }
  }

  header("Location: index.php");
  exit;
}

function validateUserInputComplete() {

  foreach (EXPECTED_FIELD_NAMES as $fieldName) {

    if(!isset($_POST[$fieldName]) || $_POST[$fieldName] === '') {
      backToInputWithError("Bitte alle Felder ausfüllen, es fehlt '$fieldName.'");
    }
  }
}

validateUserInputComplete();

$participantCounts = new ParticipantCounts(
    $_POST["groupId"],
    $_POST["trainingDate"],
    $_POST["coachId"],
    $_POST["femaleUnder18"],
    $_POST["maleUnder18"],
    $_POST["femaleOver18"],
    $_POST["maleOver18"]);

try {
  unset($_SESSION['formValidationError']);
  $participantCounts->save();

  foreach (EXPECTED_FIELD_NAMES as $fieldName) {
    unset($_SESSION[$fieldName]);
  }

  saveUserAgentStats();
  header("Location: success.html");
  exit;
} catch(Exception $e) {
  backToInputWithError("Fehler beim Speichern: " . $e->getMessage());
}



 ?>
