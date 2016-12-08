<?php
namespace base\model\entity;

use base\model\entity\shape\Shape;

class EntityFactory
{
    /**
     * Default namespace for entity
     *
     * @var string
     */
	protected $namespace = 'project\\model';


    /**
     * Factory method to build an entity based on name
     * If built entity is not a child of Entity, default entity is returned
     *
     * @param $name
     * @return Entity
     */
	public function getEntity($name,$shape = null)
	{
        $className = $this->buildEntityClassName($name);
        if (! is_a($className, Entity::class, true)) {
            $className = $this->getDefaultEntityClassName();
        }

        $entity = new $className($name);

        if ($shape instanceof Shape) {
            foreach($shape->attributes as $key) {
                $entity->setAttribute($key);
            }
        }

        return $entity;
	}

    /**
     * Allow to change directory namespace
     *
     * @param string $namespace
     */
	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
	}

    /**
     * Build an entity className based on a name
     *
     * @param $name
     * @return string
     */
	protected function buildEntityClassName($name)
    {
        $namespace = rtrim($this->namespace, '/\\') . '\\';
        return $namespace .$name;
    }

    /**
     * Return the default className for an entity
     *
     * @return string
     */
	protected function getDefaultEntityClassName()
    {
        return Entity::class;
    }
}

