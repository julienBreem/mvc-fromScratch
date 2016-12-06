<?php
namespace base\model\entity;

class EntityShaper
{
	
	protected $entityFactory;
	
	public function __construct($entityFactory)
	{
		$this->entityFactory = $entityFactory;
	}
	public function shape(dataMapper $dataMapper)
	{
		$entity = $this->entityFactory->getEntity($name);
		if (is_null($entity->getRepositoryName())) {
			$entity->setRepositoryName($name);
			foreach($dataMapper->fetchColumns($name) as $id => $name)
			{
				$entity->attributes[$name] = "";
			}
		}
	}
}