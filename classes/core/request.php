<?php
namespace core;
class request{
	
	protected $uri;
	protected $params;
	protected $resourceName = "site";
	protected $command = "index";
	
	public function __construct( $uri )
    {
		$this->uri = $uri;
		if(strpos($uri, "?")){
			$urlString = substr($uri, strpos($uri, "?") + 1); 
			$urlTab = explode("&",$urlString);
			foreach($urlTab as $param){
				$key = explode("=",$param)[0];
				$value = explode("=",$param)[1];
				if($key == "c")$this->resourceName = $value;
				elseif($key == "a")$this->command = $value;
				else $this->params[] = [$key => $value];
			}
		}
	}
	
	public function getUri()
	{
		return $this->uri;
	}
	public function getResourceName()
	{
		return $this->resourceName;
	}
	public function getCommand()
	{
		return $this->command;
	}
	public function getParams()
	{
		return $this->params;
	}
}

?>