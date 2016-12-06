<?php
namespace base\model;

use base\model\entity\EntityFactory;
use base\model\dataMapper\DataMapperFactory;

class Service
{	
	protected $dataMapper;
	protected $entityFactory;
	
	public function __construct($modelConfig)
    {
		$dataMapperFactory = new DataMapperFactory($modelConfig["dataConnection"]);
		$this->dataMapper = $dataMapperFactory->getDataMapper();
	}
	
	public function buildEntity( $name )
	{
		$this->entityFactory = new EntityFactory();
		$entity = $this->entityFactory->getEntity($name);
		
		//si l'entity est "vide"
		if(is_null($entity->getRepositoryName())){
			$entity->setRepositoryName($name);
			foreach($this->dataMapper->fetchColumns($name) as $id => $name){
				$entity->attributes[$name] = "";
			}
		}		
		
		return $entity;
	}
	public function getEntityById( $modelName,$id )
	{
		$entity = $this->buildEntity($modelName);
		$attributes = $this->dataMapper
						->select($entity->getRepositoryName())
						->where(["id=".$id])
						->execute();
		foreach($entity->attributes as $id => $values){
			if(ISSET($attributes[$id])){
				$entity->attributes[$id] = $attributes[$id];
			}
		}
		return $entity;
	}	
	
}