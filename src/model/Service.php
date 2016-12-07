<?php
namespace base\model;

use base\model\entity\EntityFactory;
use base\model\entity\Entity;
use base\model\entity\shaper\EntityShaperFactory;
use base\model\dataMapper\DataMapperFactory;

class Service
{	
	protected $dataMapper;
	
	public function __construct($modelConfig)
    {
		$dataMapperFactory = new DataMapperFactory($modelConfig["dataConnection"]);
		$this->dataMapper = $dataMapperFactory->getDataMapper();
	}

    /**
     *
     * The purpose of this function is building the right
     * entity and shape it if necessary
     *
     * @param $name The className or the Name of the entity to build
     * @return mixed
     */
    public function buildEntity($name)
	{
		$entityFactory = new EntityFactory();
		$entity = $entityFactory->getEntity($name);
        if (!$this->isShaped($entity)) {
            $shaperFactory = new EntityShaperFactory($this->dataMapper);
            $shaper = $shaperFactory->getEntityShaper();
            $entity = $shaper->shape($entity);
        }
		return $entity;
	}

    /**
     *
     * This method will retrieve the entity from the data source
     * by name and id.
     *
     * @param $entityName name of the entity ( eg: its class )
     * @param $id id of the entity ( dataSource's id )
     * @return mixed
     */
    public function getEntityById($entityName, $id)
	{
		$entity = $this->buildEntity($entityName);
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

	public function isShaped(Entity $entity)
    {
        return (is_array($entity->getAttributes()) and count($entity->getAttributes())>0);
    }
	
}