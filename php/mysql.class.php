<?php

require_once("base.class.php");

class mysql extends base
{
  public $mh = NULL;

  function __autoload($class)
  {
    require_once("$class.class.php");
  }

  function __construct($config)
  {
    $this->config = $config;
    parent::__construct();
    $this->connect();
  }

  function escape($thing)
  {
    if(is_array($thing))
      {
	foreach($thing as $key => &$value)
	  {
	    $key = $this->escape($key);
	    $value = $this->escape($value);
	  }
	return $thing;
      }
    else
      return mysql_real_escape_string($thing);
  }

  function connect()
  {
    try
      {
	$this->mh = new PDO(
			    'mysql:host=' . $this->config->sqlmyHOST . ';dbname=' . $this->config->mysqlDB, 
			    $this->config->mysqlUSER,
			    $this->config->mysqlPASS
			    );
      }
    catch (PDOException $e)
      {
	$this->error($e->getMessage());
      }
  }
}

?>