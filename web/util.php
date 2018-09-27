<?php

function backToInputWithError($errorMessage) {
  $_SESSION['formValidationError'] = $errorMessage;
  header("Location: index.php");
  exit;
}
 ?>
