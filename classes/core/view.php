<?php
namespace core;
class view{
	
	protected $css;
	protected $js;
	public $title;
	
	protected $header;
	protected $body;
	protected $footer;
	protected $templateLocation;
	protected $models;
	
	public function setDefaultTemplateLocation( $templateLocation ){
		$this->header = $templateLocation."/header.php";
		$this->footer = $templateLocation."/footer.php";
	}
	
	public function setBody( $body ){
		$this->body = $body;
	}
	
	public function setModels( $models ){
		$this->models = $models;
	}
	
	public function render(){
		include($this->header);
		if($this->body!="")include($this->body);
		include($this->footer);
	}
}
?>