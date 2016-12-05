<?php
namespace core;
class modelFactory{
	
	protected $directory = "model";
	protected $dataMapper; 
	
	
	public function __construct( $dataMapper )
    {
		$this->dataMapper = $dataMapper;
	}
	
	public function buildModel( $name )
	{
		if($this->directory !== false){
			
		}
		else{
			require('./classes/service/autoGenModel.php');
			$model = new \service\autoGenModel($name);
			$this->dataMapper->connect();
			foreach($this->dataMapper->fetchColumns($name) as $id => $name)$model->attributes[$name] = "";
			return $model;
		}
	}
	public function setDirectory($directory)
	{
		$this->directory = $directory;
	}
}

?>