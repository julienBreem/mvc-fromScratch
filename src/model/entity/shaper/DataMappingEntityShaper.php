<?php
namespace base\model\entity\shaper;


use base\model\entity\Entity;
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

    public function shape(Entity $entity)
	{
		if (is_null($entity->getRepositoryName())) {
            $entity->setRepositoryName($entity->getName());
        }
        if (!is_array($entity) or count($entity)==0) {
            $attributes = [];
		    foreach ($this->dataMapper->fetchColumns($entity->getRepositoryName()) as $id => $name) {
                $attributes[$name] = "";
            }
            $entity->setAttributes($attributes);
        }
		return $entity;
	}
}