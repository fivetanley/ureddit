<?php

require_once("base.class.php");

class dbpdo extends base
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
			    $this->config->driver() . ':host=' . $this->config->host() . ';dbname=' . $this->config->db(), 
			    $this->config->user(),
			    $this->config->pass()
			    );
      }
    catch (PDOException $e)
      {
	$this->error($e->getMessage());
      }
  }
}

?>