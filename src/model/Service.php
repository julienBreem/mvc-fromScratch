<?php
namespace base\model;

use base\model\entity\AutoGenEntityFactory;
use base\model\entity\EntityFactory;
use base\model\dataMapper\DataMapperFactory;

class Service
{	
	protected $dataMapper;
	protected $entityFactory;
	protected $entityType;
	
	public function __construct($modelConfig)
    {
		$dataMapperFactory = new DataMapperFactory($modelConfig["dataConnection"]);
		$this->dataMapper = $dataMapperFactory->getDataMapper();
		$this->entityType = $modelConfig["entityType"];
	}
	
	public function buildEntity( $name ){
		
		switch($this->entityType){
			case "autoGen":
				$this->entityFactory = new AutoGenEntityFactory();
				$attributes = "";
				foreach($this->dataMapper->fetchColumns($name) as $id => $name)$attributes[$name] = "";
				return $this->entityFactory->getEntity($name,$attributes);
				break;
			case "normal":
				$this->entityFactory = new EntityFactory();
				return $this->entityFactory->getEntity($name);
				break;
		}
		
	}
	public function getEntityById( $modelName,$id ){
		$entity = $this->buildEntity($modelName);
		$attributes = $this->dataMapper->select($modelName)->where(["id=1"])->execute();
		foreach($entity->attributes as $id => $values)$entity->attributes[$id] = $attributes[$id];
		return $entity;
	}	
	
}