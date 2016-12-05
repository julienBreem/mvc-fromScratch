<?php
namespace service;
class modelService{
	
	protected $dataMapper;
	protected $modelFactory;
	protected $modelType;
	
	public function __construct($dataMapper,$modelType)
    {
		$this->dataMapper = $dataMapper;
		$this->modelType = $modelType;
	}
	
	public function buildModel( $name ){
		switch($this->modelType){
			case "autoGen":
				$path = "./classes/core/autogenModelFactory.php";
				$modelFactory  = "core\\autogenModelFactory";
				require_once($path);
				$this->modelFactory = new $modelFactory();
				$attributes = "";
				foreach($this->dataMapper->fetchColumns($name) as $id => $name)$attributes[$name] = "";
				return $this->modelFactory->getModel($name,$attributes);
				break;
			case "normal":
				$path = "./classes/core/modelFactory.php";
				$modelFactory  = "core\\modelFactory";
				require_once($path);
				$this->modelFactory = new $modelFactory();
				return $this->modelFactory->getModel($name);
				break;
		}
		
	}
	public function getModelById( $modelName,$id ){
		$entity = $this->buildModel($modelName);
		$attributes = $this->dataMapper->select($modelName)->where(["id=1"])->execute();
		foreach($entity->attributes as $id => $values)$entity->attributes[$id] = $attributes[$id];
		return $entity;
	}
	
	
}