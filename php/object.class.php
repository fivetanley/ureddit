<?php

require_once("base.class.php");

class object extends base
{

  public $new = false;
  public $ring = NULL;
  public $id = NULL;
  public $type = NULL;
  public $value = NULL;
  public $created = NULL;
  public $modified = NULL;
  public $children = NULL;
  public $parents = NULL;
  public $attributes = NULL;
  public $table = "objects";
  public $dbpdo = NULL;

  function __autoload($class)
  {
    require_once("$class.class.php");
  }

  function __construct($dbpdo, $id = NULL)
  {
    $this->dbpdo = $dbpdo;
    if($id !== NULL)
      $this->lookup($id);
  }

  function use_connection($mh)
  {
    $this->mh = $mh;
  }

  function lookup($id)
  {
    $q = "SELECT * FROM ? WHERE ? = ?";
    $data = $this->dbpdo->query($q, array(
					  $this->table,
					  "id",
					  $id));
    $data = $data[0];

    $this->new = false;
    $this->ring = $data['ring'];
    $this->id = $id;
    $this->type = $data['type'];
    $this->value = $data['value'];
    $this->created = $data['creation'];
    $this->modified = $data['modification'];

    $this->unsaved = false;
  }

  function lookup_parents_by_type($id, $type)
  {
    $q = "SELECT p.id AS parent_id, p.type AS parent_type, p.value AS parent_value, a.id AS association_id, a.type AS association_type, a.value AS association_value FROM objects p INNER JOIN ( associations a INNER JOIN objects c ON a.child_id = c.id WHERE c.id = ? AND a.type = ?) on p.id = a.parent_id";
    $data = $this->dbpdo->query($q, array($this->id, $type));
    foreach($data as $assoc)
      {
	$this->parents[$type][] = array(
					$assoc['parent_id'],
					$assoc['parent_type'],
					$array['parent_value']
					);
	$this->associations[] = array(
				      $assoc['association_id'], 
				      $assoc['association_type'],
				      $assoc['association_value']
				      );
      }
  }

  function lookup_children($id, $type)
  {
    $q = "SELECT c.id AS child_id, c.type AS child_type, c.value AS child_value, a.id AS association_id, a.type AS association_type, a.value AS association_value FROM objects c INNER JOIN ( associations a INNER JOIN objects p ON a.child_id = p.id WHERE p.id = ? AND a.type = ?) on c.id = a.parent_id";
    $data = $this->dbpdo->query($q, array($this->id, $type));
    foreach($data as $assoc)
      {
	$this->children[$type][] = array(
					$assoc['child_id'],
					$assoc['child_type'],
					$array['child_value']
					);
	$this->associations[] = array(
				      $assoc['association_id'], 
				      $assoc['association_type'],
				      $assoc['association_value']
				      );
      }
  }

  function save()
  {
    // changes to object data are cached in the runtime object and then saved when appropriate, either when save() is explicitly called or when the destructor is called
  }

  function __destruct()
  {
    if($this->unsaved)
      $this->save();
  }

}

?>