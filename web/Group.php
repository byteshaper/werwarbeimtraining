<?php
require_once("ReadOnlyEntity.php");

class Group extends ReadOnlyEntity {

  public static function loadAllGroups() {
    return parent::loadAll("groups");
  }

  public static function loadGroupNameById($id) {
    return parent::loadNameById("groups", $id);
  }
}

?>
