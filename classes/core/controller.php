<?php
namespace core;
class controller{
	
	protected $view;
	protected $modelService;
	protected $name;
	public function __construct( $view, $modelService )
    {
		$this->view = $view;
		$this->modelService = $modelService;
	}
	
	public function setName( $name ){
		$this->name = $name;
	}
	public function getName(){
		return $this->name;
	}
	public function setView( $view ){
		$this->view = $view;
	}
	public function getView(){
		return $this->view;
	}
	public function render( $file, $models = []){
		$this->view->setBody('./view/'.$this->name.'/'.$file.'.php');
		$this->view->setModels($models);
	}
}
