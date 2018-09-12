<?php

function createDbConnection() {
  $user = "<insert username>";
  $db = "<insert database>";
  $password = "<insert password>";
  $host = "<insert host>";
  $mysqli = new mysqli($host, $user, $password, $db);

  if($mysqli->connect_errno) {
    throw new RuntimeException("Kann mich nicht mit Datenbank verbinden: " . $mysqli->connect_errno);
  }

  $mysqli->set_charset("utf8");
  return $mysqli;
}

 ?>
