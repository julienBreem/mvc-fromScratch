<?php
namespace base\model\entity\shaper;


use base\model\entity\Entity;
use base\model\dataMapper\DataMapper;
/**
 * Class DataMappingEntityShaper
 * @package base\model\entity
 */
class DataMappingEntityShaper extends EntityShaper
{
    protected $dataMapper;

    public function __construct(DataMapper $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    public function shape(Entity $entity)
	{
		if (is_null($entity->getRepositoryName())) {
            $entity->setRepositoryName($entity->getName());
        }
        if (!is_array($entity->getAttributes()) or count($entity->getAttributes())==0) {
            $attributes = [];
		    foreach ($this->dataMapper->fetchColumns($entity->getRepositoryName()) as $id => $name) {
                $attributes[$name] = "";
            }
            $entity->setAttributes($attributes);
        }
		return $entity;
	}
}