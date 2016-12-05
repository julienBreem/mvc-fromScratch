<?php
namespace service;
require_once("./classes/core/dataMapper.php");
use core\dataMapper as dataMapper;
class sqlDataMapper extends dataMapper{
	
	protected $host;
	protected $dbname;
	protected $username;
	protected $password = '';
	protected $options;
	
	protected $dbh;
	protected $sql;
	
	public function __construct( $connection )
    {
		$attrTab = explode(";",$connection);
		foreach($attrTab as $attr){
			$temp = explode("=",$attr);
			if(ISSET($temp[0]) && ISSET($temp[1])){
				$key = $temp[0];
				$value = $temp[1];
				switch($key){
					case "host":$this->host = $value;break;
					case "dbname":$this->dbname = $value;break;
					case "username":$this->username = $value;break;
					case "password":$this->password = $value;break;
					case "options":$this->options = $value;break;
				}
			}
		}		
	}
	
	protected function connect()
	{
		$this->dbh = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
	}
	
	protected function disconnect()
	{
		$this->dbh = null;
	}
	
	public function insert( $tableName, $values )
	{
		$this->sql = "";
		$this->sql.= "INSERT into `".$tableName."`";
		$this->sql.= " (";
		foreach($values as $key => $values)$this->sql.=$key.",";
		$this->sql = substr($this->sql, 0, -1).")";
		$this->sql.= " VALUES ";
		$this->sql.= " (";
		foreach($values as $key => $values)$this->sql.="'".$values."',";
		$this->sql = substr($this->sql, 0, -1).")";
		$this->execute();
		return $result;
	}
	public function select( $tableName )
	{
		$this->sql = "";
		$this->sql.= "SELECT * FROM `".$tableName."`";
		return $this;
	}
	public function update( $tableName, $values )
	{
		$this->sql = "";
		$this->sql.= "UPDATE `".$tableName."` SET ";
		foreach($values as $id => $value)$this->sql.= $id."='".$value."',";
		$this->sql = substr($this->sql, 0, -1);
		return $this;
	}
	public function delete( $tableName )
	{
		$this->sql = "";
		$this->sql.= "DELETE FROM `".$tableName."`";
		return $this;
	}
	public function limit( $limit )
	{
		$this->sql.= " LIMIT ".$limit;
		return $this;
	}
	public function where( $conditions )
	{
		$this->sql.= " WHERE ";
		foreach($conditions as $condition)$this->sql.= $condition." AND ";
		$this->sql = substr($this->sql, 0, -5);
		return $this;
	}
	public function execute()
	{
		$this->sql.= ";";
		$this->connect();
		$q = $this->dbh->prepare($this->sql);
		$q->execute();
		$result = $q->fetch();
		$this->disconnect();
		return $result;
	}
	public function fetchColumns( $tableName )
	{
		$this->connect();
		$q = $this->dbh->prepare("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$this->dbname."' AND `TABLE_NAME`='".$tableName."'");
		$q->execute();
		$result = $q->fetchAll(\PDO::FETCH_COLUMN);		
		$this->disconnect();
		return $result;
	}
}
