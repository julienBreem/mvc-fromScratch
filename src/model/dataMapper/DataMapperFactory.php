<?php
namespace base\model\dataMapper;

class DataMapperFactory
{	
	protected $type;
	protected $connectionString;
	
	public function __construct( $connectionConfig )
    {
		$temp = explode(":",$connectionConfig);
		$this->type = $temp[0];
		$this->connectionString = $temp[1];
	}
	
	public function getDataMapper()
	{
		$dataMapper = null;
		switch($this->type){
			case "mysql":
				$dataMapper = new SqlDataMapper($this->connectionString);
				break;
		}
		return $dataMapper;
	}
}
