<?php
namespace base\model;

use base\model\entity\EntityFactory;
use base\model\entity\shaper\EntityShaperFactory;
use base\model\dataMapper\DataMapperFactory;

class Service
{	
	protected $dataMapper;
	protected $entityFactory;

	public function __construct($modelConfig)
    {
		$dataMapperFactory = new DataMapperFactory($modelConfig["dataConnection"]);
		$this->dataMapper = $dataMapperFactory->getDataMapper();
		$this->entityFactory = new EntityFactory($modelConfig["namespace"]);
	}

    /**
     *
     * The purpose of this function is building the right
     * entity and shape it if necessary
     *
     * @param $name string The className or the Name of the entity to build
     * @return mixed
     */
    public function buildEntity($name)
	{
        $shaperFactory = new EntityShaperFactory($this->dataMapper);
        return $shaperFactory->getEntityShaper()->shape($this->entityFactory->getEntity($name));
	}

    /**
     *
     * This method will retrieve the entity from the data source
     * by name and id.
     *
     * @param $entityName string name of the entity ( eg: its class )
     * @param $id integer id of the entity ( dataSource's id )
     * @return mixed
     */
    public function getEntityById($entityName, $id)
	{
		$entity = $this->buildEntity($entityName);
		$data = $this->dataMapper
						->select($entity->getRepositoryName())
						->where(["id=".$id])
						->execute();
		foreach($entity->getAttributes() as $id => $values)
		{
			if (isset($data[$id])) {
				$entity->setAttribute($id,$data[$id]);
			}
		}
		return $entity;
	}
	
}