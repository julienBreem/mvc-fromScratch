<?php
namespace base\model\entity;

use base\core\Factory;

class EntityFactory extends Factory
{
    /**
     * Default namespace for entity
     *
     * @var string
     */
	protected $namespace = 'project\\model';
    protected $defaultClassName = Entity::class;
    protected $mainClass = Entity::class;

    public function getEntity($name)
    {
        $className = $this->getClassName($name);
        return new $className($name);
    }
}

