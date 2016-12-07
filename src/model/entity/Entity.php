<?php
namespace base\model\entity;

class Entity
{
	protected $attributes;
	protected $name;
	protected $repositoryName = null;
	
	public function getRepositoryName()
	{
		return $this->repositoryName;
	}
	public function setRepositoryName($repositoryName)
	{
		$this->repositoryName = $repositoryName;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
	public function getAttributes()
	{
		return $this->attributes;
	}
	public function setAttributes($attributes)
	{
		$this->attributes = $attributes;
	}
	public function getAttribute($id)
    {
        return $this->attributes[$id];
    }
    public function setAttribute($id,$value)
    {
        $this->attributes[$id] = $value;
    }
}
