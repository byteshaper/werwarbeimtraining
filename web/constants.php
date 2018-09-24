<?php

define("FIELD_NAME_COACH", "coachId");
define("FIELD_NAME_GROUP", "groupId");
define("FIELD_NAME_TRAININGDATE", "trainingDate");
define("FIELD_NAME_FEMALE_UNDER", "femaleUnder18");
define("FIELD_NAME_MALE_UNDER", "maleUnder18");
define("FIELD_NAME_FEMALE_OVER", "femaleOver18");
define("FIELD_NAME_MALE_OVER", "maleOver18");

define("EXPECTED_FIELDS", array(
  FIELD_NAME_COACH => "Trainer*in",
  FIELD_NAME_GROUP => "Gruppe",
  FIELD_NAME_TRAININGDATE => "Trainingsdatum",
  FIELD_NAME_FEMALE_UNDER => "Schwimmer<strong>innen unter</strong> 18",
  FIELD_NAME_MALE_UNDER => "Schwimmer unter 18",
  FIELD_NAME_FEMALE_OVER => "Schwimmerinnen über 18",
  FIELD_NAME_MALE_OVER => "Schwimmer über 18"));

 ?>
