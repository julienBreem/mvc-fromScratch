<?php
namespace base\model\entity;

class EntityFactory
{
	protected $directory = "model";
	
	public function getEntity( $name )
	{
		if (file_exists('./project/'.$this->directory.'/'.$name.'.php')) {
			$class = "project\\".$this->directory."\\".$name;
		}
		else{
			$class = "base\\model\\entity\\entity";
		}
		$entity = new $class();
		if ( $entity instanceof Entity) return $entity;
		// else echo "entityError";exit;
	}
	public function setDirectory( $directory )
	{
		$this->directory = $directory;
	}
}

