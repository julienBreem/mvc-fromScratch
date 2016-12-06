<?php
namespace base\view;

class viewFactory
{	
	protected $directory = "view";
	
	public function getView( $request )
	{
		$class = 'project\\'.$this->directory. '\\' . $request->getControllerName();
		return new $class();
	}
}

