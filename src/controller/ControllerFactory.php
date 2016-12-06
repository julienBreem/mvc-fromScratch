<?php
namespace base\controller;

class controllerFactory
{
	protected $directory = "controller";
	
	public function getController( $request, $view, $modelService )
	{
		$class = 'project\\'.$this->directory. '\\' . $request->getControllerName();
		$controller = new $class($view, $modelService);
		$controller->setName($request->getControllerName());
		return $controller;
	}
}

