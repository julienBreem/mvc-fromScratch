<?php
namespace base\model;

class AutoGenEntityFactory{
	
	public function getEntity( $name, $attributes )
	{
		$model = new AutoGenEntity($name);
		$model->attributes = $attributes;
		return $model;
	}
}

