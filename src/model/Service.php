<?php
namespace base\model;

use base\model\entity\EntityFactory;
use base\model\dataMapper\DataMapperFactory;

class Service
{
    protected $modelConfig;
	protected $dataMapper;
	protected $entityFactory;

	public function __construct($modelConfig)
    {
        $this->modelConfig = $modelConfig;
		$dataMapperFactory = new DataMapperFactory($this->modelConfig['dataConnection']);
		$this->dataMapper = $dataMapperFactory->getDataMapper();
		$this->entityFactory = new EntityFactory();
		if (! empty($this->modelConfig['namespace'])) {
		    $this->entityFactory->setNamespace($this->modelConfig['namespace']);
        }
	}

    /**
     *
     * The purpose of this function is building the right
     * entity and hydrate it if necessary
     *
     * @param $entityName string The className or the Name of the entity to build
     * @return mixed
     */
    public function buildEntity($entityName)
    {
        $entity = $this->entityFactory->getEntity($entityName);
	    if ($this->modelConfig['entities'][$entityName]['autoComplete']) {
            $this->dataMapper->hydrate($entity,$this->modelConfig['entities'][$entityName]['repositoryName']);
        }
        return $entity;
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
						->select($this->modelConfig['entities'][$entityName]['repositoryName'])
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