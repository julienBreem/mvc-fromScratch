<?php
namespace core;
class dataMapperFactory{
	
	protected $type;
	protected $connectionString;
	
	public function __construct( $connection )
    {
		$temp = explode(":",$connection);
		$this->type = $temp[0];
		$this->connectionString = $temp[1];
	}
	
	public function getDataMapper()
	{
		$dataMapper = null;
		switch($this->type){
			case "mysql":
				require("./classes/service/sqlDataMapper.php");
				$dataMapper = new \service\sqlDataMapper($this->connectionString);
				break;
		}
		return $dataMapper;
	}
}

?>