<?php
namespace base\model;

class EntityFactory
{
	protected $directory = "model";
	
	public function getEntity( $name )
	{
		$class = "project\\".$this->directory."\\".$name;
		return new $class();
	}
	public function setDirectory($directory)
	{
		$this->directory = $directory;
	}
}

