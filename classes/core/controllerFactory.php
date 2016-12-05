<?php
namespace core;
class controllerFactory{
	
	protected $directory = "controller";
	
	
	public function __construct()
    {
		
	}
	
	public function getController( $request, $view, $modelFactory )
	{
		include("./".$this->directory."/".$request->getResourceName().".php");
		$class = $this->directory. '\\' . $request->getResourceName();
		$controller = new $class($view, $modelFactory);
		$controller->setName($request->getResourceName());
		return $controller;
	}
}

?>