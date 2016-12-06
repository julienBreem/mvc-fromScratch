<?php
namespace base\model;

use base\model\entity\EntityFactory;
use base\model\entity\EntityShaper;
use base\model\dataMapper\DataMapperFactory;

class Service
{	
	protected $dataMapper;
	
	public function __construct($modelConfig)
    {
		$dataMapperFactory = new DataMapperFactory($modelConfig["dataConnection"]);
		$this->dataMapper = $dataMapperFactory->getDataMapper();
	}
	
	public function buildEntity( $name )
	{
		$entityFactory = new EntityFactory();
		$shaper = new EntityShaper();	
		return $shaper->shape($this->dataMapper,$entityFactory->getEntity($name));
	}
	public function getEntityById( $modelName,$id )
	{
		$entity = $this->buildEntity($modelName);
		$attributes = $this->dataMapper
						->select($entity->getRepositoryName())
						->where(["id=".$id])
						->execute();
		foreach($entity->attributes as $id => $values)
		{
			if (isset($attributes[$id])) {
				$entity->attributes[$id] = $attributes[$id];
			}
		}
		return $entity;
	}	
	
}