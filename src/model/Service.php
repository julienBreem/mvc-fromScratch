<?php
namespace base\model;

use base\model\entity\EntityFactory;
use base\model\entity\shape\ShapeFactory;
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
     * entity and shape it if necessary
     *
     * @param $entityName string The className or the Name of the entity to build
     * @return mixed
     */
    public function buildEntity($entityName)
	{
        $shape = null;
	    if ($this->modelConfig['entities'][$entityName]['autoComplete']) {
            $shaperFactory = new ShapeFactory();
            $shape = $shaperFactory->getShape($this->dataMapper,$this->modelConfig['entities'][$entityName]['repositoryName']);
        }
        return $this->entityFactory->getEntity($entityName,$shape);
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