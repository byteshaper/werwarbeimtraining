<?php

require_once("dbconnectionfactory.php");

function saveUserAgentStats() {

  try {
    $selectCheckExists = "SELECT id FROM wwbt_useragentstats WHERE yearmonth = ? AND useragent = ?";
    $update = "UPDATE wwbt_useragentstats SET count = count + 1 WHERE id = ?";
    $insert = "INSERT INTO wwbt_useragentstats (yearmonth, useragent, count) VALUES (?, ?, ?);";

    $ua = substr($_SERVER['HTTP_USER_AGENT'], 0 , 255);
    $thisMonth = (int) date("Ym");

    $mysqli = createDbConnection();

    if($stmt = $mysqli->prepare($selectCheckExists)) {
      $stmt->bind_param("is", $thisMonth, $ua);

      if($stmt->execute()) {
        $result = $stmt->get_result();
        $somethingFound = $result->num_rows > 0;
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $result->close();

        if($somethingFound) {
          $stmt = $mysqli->prepare($update);
          $stmt->bind_param("i", $id);
          $stmt->execute();
        } else {
          $stmt = $mysqli->prepare($insert);
          $count = 1;
          $stmt->bind_param("isi", $thisMonth, $ua, $count);
          $stmt->execute();
        }
      }
    }

    $mysqli->close();
  } catch(Exception $e) {
    // swallow the error - useragentstats errors should never bother the users
  }
}
?>
