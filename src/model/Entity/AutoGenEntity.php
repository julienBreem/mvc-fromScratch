<?php
namespace base\model;

class AutoGenEntity extends Entity
{
	protected $name;
	
	public function __construct($name)
    {
		$this->name = $name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	public function getName()
	{
		return $this->name;
	}
}