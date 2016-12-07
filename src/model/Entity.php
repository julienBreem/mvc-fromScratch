<?php
namespace base\model\entity;

class Entity
{
	public $attributes;
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
}
