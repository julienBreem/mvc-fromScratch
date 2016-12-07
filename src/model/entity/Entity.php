<?php

namespace base\model\entity;

/**
 * Class Entity
 *
 * @package base\model\entity
 */
class Entity
{
    //protected $shaper =
    /**
     * Attributes bag
     *
     * @var array
     */
	protected $attributes = [];

    /**
     * The name of Entity
     *
     * @var string
     */
	protected $name;

    /**
     * The repository name associated to $this entity
     *
     * @todo Move it to a repositoryFactory
     * @var string
     */
	protected $repositoryName = null;

    /**
     * Entity constructor.
     *
     * @param string $name
     */

    public function __construct($name,$shape)
    {
        $this->name = $name;
        $this->repositoryName = $name;
    }
    /**
     * Return the repository name of $this entity
     *
     * @todo Move it to a repositoryFactory
     * @return string
     */
    public function getRepositoryName()
	{
		return $this->repositoryName;
	}

    /**
     * Set the repository name of $this entity
     *
     * @todo Move it to a repositoryFactory
     * @param $repositoryName
     */
	public function setRepositoryName($repositoryName)
	{
		$this->repositoryName = $repositoryName;
	}

    /**
     * Return the name of $this entity
     *
     * @return string
     */
	public function getName()
	{
		return $this->name;
	}

    /**
     * Return all attributes of $this entity
     *
     * @return array
     */
	public function getAttributes()
	{
		return $this->attributes;
	}

    /**
     * Set all attributes of $this entity
     *
     * @params array $attributes
     * @return Entity
     */
	public function setAttributes(array $attributes)
	{
		$this->attributes = $attributes;
        return $this;
	}

    /**
     * Check if $this entity has at least one attribute
     *
     * @return bool
     */
	public function hasAttributes()
    {
        return ! empty($this->attributes);
    }

    /**
     * Get the value associated to the given attributes $key
     * Return null if $key does not exist or is not valid
     *
     * @params string $key
     * @return Entity
     */
	public function getAttribute($key)
    {
        return $this->hasAttribute($key) ? $this->attributes[$key] : null;
    }

    /**
     * Set an attribute $value for the given $key
     * $key has to be a valid $key
     *
     * @param $key
     * @param $value
     * @return Entity
     */
    public function setAttribute($key, $value)
    {
        if ($this->isValidKey($key)) {
            $this->attributes[$key] = $value;
        }
        return $this;
    }

    /**
     * Check if $this entity has at the given attribute $key
     * $key has to be a valid key, otherwise false is returned
     *
     * @return bool
     */
    public function hasAttribute($key)
    {
        if (! $this->isValidKey($key)) {
            return false;
        }
        return array_key_exists($key, $this->attributes);
    }

    /**
     * Check if the given $key is valid by checking if it is a string or an integer
     *
     * @param $key
     * @return bool
     */
    protected function isValidKey($key)
    {
        return (is_string($key) || is_int($key));
    }
}