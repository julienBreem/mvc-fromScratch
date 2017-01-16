<?php

/**
 * Created by Julien Breem.
 * Date: 12/12/2016
 * Time: 16:38
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2016
 **/
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