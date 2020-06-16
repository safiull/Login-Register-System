<?php

class myDataBase{
	private $dbHost = "localhost";
	private $dbUser = "root";
	private $dbPass = "";
	private $dbName = "login-register";
	public $pdo;

	public function __construct(){
		if (!isset($this->pdo)) {
			try{
				$link = new PDO("mysql:host=".$this->dbHost."; dbname=".$this->dbName, $this->dbUser, $this->dbPass);
				$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$link->exec("SET CHARACTER SET utf8");
				$this->pdo = $link;
			}catch(PDOException $e){
				die("Faild TO connect with Database".$e->getMessage());
			}
		}
	}
}