<?php
namespace base\view;

use base\core\http\appResponse;

abstract class View extends appResponse
{
	protected $models;
	
	public function setModels( $models ){
		$this->models = $models;
	}
    abstract public function render();
}