<?php
namespace core;
class autogenModelFactory{
	
	public function __construct( )
    {
	}
	
	public function getModel( $name, $attributes )
	{
		require_once('./classes/service/autoGenModel.php');
		$model = new \service\autoGenModel($name);
		$model->attributes = $attributes;
		return $model;
	}
}

