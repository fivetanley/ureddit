<?php

class base {
  public $config;
  public $mysql;

  function __autoload($class)
  {
    require_once("$class.class.php");
  }

  function __construct($config)
  {
    $this->config = $config;
    $this->mysql = new mysql($config);
  }

  function error($arg, $log = false)
  {
    if($log)
      {
	$trace = debug_backtrace();
	$this->log("=====================\n");
	$this->log("ERROR: " . $arg . "\n");
	$this->log(implode('\n',$trace));
	$this->log("=====================\n");
      }
    die($arg);
  }

  function log($msg, $logfile = "log.txt")
  {
    if(!($fh = fopen($logfile, "at")))
      die("<strong>ERROR</strong>: Could not open $logfile for logging.");
    $fwrite($fh, $msg."\n");
    @fclose($fh);
  }
}

?>