<?php
require_once("ReadOnlyEntity.php");

class Coach extends ReadOnlyEntity {

  public static function loadAllCoaches() {
    return parent::loadAll("coaches");
  }
}

?>
