<?php
namespace base\model\entity;

class EntityShaper
{
	public function shape($dataMapper,$entity)
	{
		if (is_null($entity->getRepositoryName())) {
			$entity->setRepositoryName($entity->getName());
			foreach($dataMapper->fetchColumns($entity->getRepositoryName()) as $id => $name)
			{
				$entity->attributes[$name] = "";
			}
		}
		
		return $entity;
	}
}