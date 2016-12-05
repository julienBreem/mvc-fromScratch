<?php
namespace service;
require("./classes/core/dataMapper.php");
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
	
	public function connect()
	{
		$this->dbh = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
	}
	
	public function disconnect()
	{
		$this->dbh = null;
	}
	
	public function create( $modelName, $values )
	{
		$sql = "INSERT into ".$modelName;
		$sql.= " (";
		foreach($values as $key => $values)$sql.=$key.",";
		$sql = substr($sql, 0, -1).")";
		$sql.= " VALUES ";
		$sql.= " (";
		foreach($values as $key => $values)$sql.="'".$values."',";
		$sql = substr($sql, 0, -1).")";
		$q = $this->dbh->prepare($sql);
		return $q->execute();		
	}
	public function read( $modelName )
	{
		
	}
	public function update( $modelName, $values )
	{
		
	}
	public function delete( $modelName )
	{
		
	}
	
	public function fetchColumns( $modelName )
	{
		$q = $this->dbh->prepare("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".$this->dbname."' AND `TABLE_NAME`='".$modelName."'");
		$q->execute();
		return $q->fetchAll(\PDO::FETCH_COLUMN);		
	}
}
?>