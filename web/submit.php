<?php

session_start();

require_once("constants.php");
//require_once("ParticipantCounts.php");
//require_once("Coach.php");
//require_once("Group.php");
//require_once("useragentstats.php");

function backToInputWithError($errorMessage) {
  $_SESSION['formValidationError'] = $errorMessage;
  header("Location: index.php");
  exit;
}

function postToSession() {
  foreach (array_keys(EXPECTED_FIELDS) as $fieldName) {
    if(isset($_POST[$fieldName]) && $_POST[$fieldName] !== '') {
      $_SESSION[$fieldName] = $_POST[$fieldName];
    } else {
      unset($_SESSION[$fieldName]);
    }
  }
}

function validateUserInputComplete() {

  $missingFieldNames = array();

  foreach (array_keys(EXPECTED_FIELDS) as $fieldName) {

    if(!isset($_POST[$fieldName]) || $_POST[$fieldName] === '') {
      $missingFieldNames[] = EXPECTED_FIELDS[$fieldName];
    }
  }

  if(!empty($missingFieldNames)) {
    $errorMessage = "Bitte alle Felder ausfüllen, es fehlen: <ul>";

    foreach($missingFieldNames as $missingFieldName) {
      $errorMessage .= "<li>$missingFieldName</li>";
    }

    $errorMessage .= "</ul>";
    backToInputWithError($errorMessage);
  }
}

postToSession();
validateUserInputComplete();
header("Location: confirm.php");
exit;

 ?>
