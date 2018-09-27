<?php
require_once("dbconnectionfactory.php");

class ReadOnlyEntity {

  private static $SELECT = "SELECT id, name FROM wwbt_<TABLENAME> ORDER BY name";

  private static $SELECT_BY_ID = "SELECT name FROM wwbt_<TABLENAME> WHERE id = ?";

  public $id;

  public $name;

  protected function __construct($id, $name) {
    $this->id = (int) $id;
    $this->name = $name;
  }

  protected static function loadAll($tableNameSuffix) {
    $mysqli = createDbConnection();
    $items = array();

    if($result = $mysqli->query(str_replace("<TABLENAME>", $tableNameSuffix, self::$SELECT))) {

        while($row = $result->fetch_object()) {
            $items[] = new ReadOnlyEntity($row->id, $row->name);
        }

        $result->close();
    } else {
      throw new RuntimeException("Fehler beim Ausführen des DB-Select: " . $mysqli->errno . " / " . $mysqli->error);
    }

    $mysqli->close();
    return $items;
  }

  protected static function loadNameById($tableNameSuffix, $id) {
    $mysqli = createDbConnection();
    $stmt = $mysqli->prepare(str_replace("<TABLENAME>", $tableNameSuffix, self::$SELECT_BY_ID));
    $idAsInt = (int) $id;
    $stmt->bind_param("i", $idAsInt);
    $stmt->execute();
    $result = $stmt->get_result();
    $name = $result->fetch_assoc()['name'];
    $mysqli->close();
    return $name;
  }
}

?>
