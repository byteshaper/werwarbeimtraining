<?php

require_once("dbconnectionfactory.php");

class ParticipantCounts {

  private static $CHECK_UNIQUE = "SELECT submitted_at FROM wwbt_participantcounts WHERE group_id = ? AND trainingdate = ?";

  private static $INSERT = "INSERT INTO wwbt_participantcounts (group_id, trainingdate, coach_id, male_under_18, female_under_18, female_over_18, male_over_18, submitted_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  public $groupId;

  public $trainingDate;

  public $coachId;

  public $maleUnder18;

  public $femaleUnder18;

  public $femaleOver18;

  public $maleOver18;

  public $submittedAt;

  public function __construct($groupId, $trainingDate, $coachId, $femaleUnder18, $maleUnder18, $femaleOver18, $maleOver18) {
    $this->trainingDate = date("Y-m-d", strtotime($trainingDate));
    $this->groupId = (int) $groupId;
    $this->coachId = (int) $coachId;
    $this->femaleUnder18 = (int) $femaleUnder18;
    $this->maleUnder18 = (int) $maleUnder18;
    $this->femaleOver18 = (int) $femaleOver18;
    $this->maleOver18 = (int) $maleOver18;
    $this->submittedAt = date("Y-m-d H:i:s");
  }

  public function save() {
    $mysqli = createDbConnection();

    if($stmt = $mysqli->prepare(self::$CHECK_UNIQUE)) {
      $stmt->bind_param("is", $this->groupId, $this->trainingDate);

      if($stmt->execute()) {
        $result = $stmt->get_result();
        $somethingFound = $result->num_rows > 0;
        $result->close();

        if($somethingFound) {
          throw new RuntimeException("Es gibt bereits einen Eintrag für diese Gruppe am Trainingstag " . $this->trainingDate);
        }
      } else {
        throw new RuntimeException("Fehler beim DB-Unique-Check: " . $mysqli->errno . " / " . $mysqli->error);
      }
    }

    if($stmt = $mysqli->prepare(self::$INSERT)) {
      $stmt->bind_param("isiiiiis", $this->groupId, $this->trainingDate, $this->coachId, $this->maleUnder18, $this->femaleUnder18, $this->femaleOver18, $this->maleOver18, $this->submittedAt);

      if(!$stmt->execute()) {
        throw new RuntimeException("Fehler beim DB-Insert: " . $mysqli->errno . " / " . $mysqli->error);
      }
    } else {
      throw new RuntimeException("Fehler beim Vorbereiten des DB-Insert: " . $mysqli->errno . " / " . $mysqli->error);
    }

    $mysqli->close();
  }
}

 ?>
