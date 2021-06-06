<?php


namespace MVCPHP\libraries;

class ImmutableDB {

	private $host;
	private $user;
	private $pass;
	private $dbname;


	public function __construct() {
		$this->host = "localhost";
    $this->user = "root";
    $this->pass = "";
    $this->dbname = "bike";
	}

	public function getHost(): string
  {
		return $this->host;
	}

	public function getUser(): string 
  {
		return $this->user;
	}

	public function getPassword():string
  {
		return $this->pass;
	}

	public function getDBName():string
  {
		return $this->dbname;
	}

}

?>