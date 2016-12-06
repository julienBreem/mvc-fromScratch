<?php
namespace base\model;

class Service
{	
	protected $dataMapper;
	protected $entityFactory;
	protected $entityType;
	
	public function __construct($dataMapper,$entityType)
    {
		$this->dataMapper = $dataMapper;
		$this->entityType = $entityType;
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