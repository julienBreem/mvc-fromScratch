<?php
namespace core;
class viewFactory{
	
	protected $directory = "view";
	
	
	public function __construct()
    {
		
	}
	
	public function getView( $request )
	{
		require_once("./".$this->directory."/".$request->getResourceName().".php");
		$class = $this->directory. '\\' . $request->getResourceName();
		return new $class();
	}
}

