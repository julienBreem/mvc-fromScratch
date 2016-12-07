<?php
namespace base\model\entity;

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
     *
     * @param $name
     * @return Entity
     */
	public function getEntity($name)
	{
        if (is_a($this->buildEntityClassName($name), Entity::class, true)) {
            $className = $this->buildEntityClassName($name);
        } else {
            $className = $this->getDefaultEntityClassName();
        }

        return new $className($name);
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
        $namespace = rtrim($name, '/\\') . '\\';
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

