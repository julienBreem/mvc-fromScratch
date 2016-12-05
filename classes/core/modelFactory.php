<?php
namespace core;
class modelFactory{
	
	protected $directory = "model";
	
	public function getModel( $name )
	{
		$path = "./".$this->directory."/".$name.".php";
		require_once($path);
		$class = "model\\".$name;
		return new $class();
	}
	public function setDirectory($directory)
	{
		$this->directory = $directory;
	}
}

