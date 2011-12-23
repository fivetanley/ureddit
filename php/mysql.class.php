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
    parent::__construct($config);
    $this->connect();
  }

  function escape($thing)
  {
    if(is_array($thing))
      {
	$esc = array();
	foreach($thing as $key => &$value)
	  $esc[$this->escape($key)] = $this->escape($value);
	return $esc;
      }
    else
      return mysql_real_escape_string($thing);
  }

  function connect()
  {
    try
      {
	$this->mh = new PDO(
			    'mysql:host=' . $this->config->mysql_host() . ';dbname=' . $this->config->mysql_db(), 
			    $this->config->mysql_user(),
			    $this->config->mysql_pass()
			    );
      }
    catch (PDOException $e)
      {
	$this->error($e->getMessage());
      }
  }
}

?>