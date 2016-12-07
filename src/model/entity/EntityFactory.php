<?php
namespace base\model\entity;

class EntityFactory
{
    /**
     * Default namespace for entity
     *
     * @var string
     */
	protected $namespace;

	public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Factory method to build an entity based on name
     * If built entity is not a child of Entity, default entity is returned
     *
     * @param $name
     * @return Entity
     */
	public function getEntity($name,$shape)
	{
        $className = $this->buildEntityClassName($name);
        if (! is_a($className, Entity::class, true)) {
            $className = $this->getDefaultEntityClassName();
        }

        return new $className($name,$shape);
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

