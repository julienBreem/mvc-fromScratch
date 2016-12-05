<?php
namespace core;
class controllerFactory{
	
	protected $directory = "controller";
	
	
	public function __construct()
    {
		
	}
	
	public function getController( $request, $view, $modelService )
	{
		include("./".$this->directory."/".$request->getResourceName().".php");
		$class = $this->directory. '\\' . $request->getResourceName();
		$controller = new $class($view, $modelService);
		$controller->setName($request->getResourceName());
		return $controller;
	}
}

