<?php

class association
{

  public $new = false;
  public $ring = NULL;
  public $id = NULL;
  public $type = NULL;
  public $value = NULL;
  public $created = NULL;
  public $modified = NULL;
  public $parent = NULL;
  public $child = NULL;
  public $attributes = NULL;
  public $table = "associations";
  public $dbpdo = NULL;

  function __construct($dbpdo, $id = NULL)
  {
    $this->dbpdo = $dbpdo;
    if($id != NULL)
      $this->lookup($id);
  }

  function lookup()
  {
    $q = "SELECT * FROM ? WHERE ? = ?";
    $data = $this->dbpdo->query($q, array(
					  $this->table,
					  "id",
					  $id
					  ));
    $data = $data[0];

    $this->new = false;
    $this->ring = $data['ring'];
    $this->id = $id;
    $this->type = $data['type'];
    $this->value = $data->value;
    $this->created = $data['creation'];
    $this->modified = $data['modification'];
  }

}

?>