<?php
namespace base\model\entity;

/**
 * Class DataMappingEntityShaper
 * @package base\model\entity
 */
class DataMappingEntityShaper implements EntityShaper
{
    protected $dataMapper;

    public function __construct($dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     *
     * Ensure the entity gets everything it needs
     * ( id, attributes, validation rules, etc )
     *
     * @param Entity $entity
     * @return Entity
     */
    public function shape(Entity $entity)
	{
		if (is_null($entity->getRepositoryName())) {
			$entity->setRepositoryName($entity->getName());
			foreach($this->dataMapper->fetchColumns($entity->getRepositoryName()) as $id => $name)
			{
				$entity->attributes[$name] = "";
			}
		}
		
		return $entity;
	}
}