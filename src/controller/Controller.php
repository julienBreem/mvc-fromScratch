<?php
namespace base\controller;

use base\view\View;

class controller
{	
	protected $view;
	protected $modelService;
	protected $name;
	public function __construct( View $view, $modelService )
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
	public function render( $file = false, $models = []){
		if($file){
		    $this->view->setHtmlBodyPath('./project/view/'.$this->name.'/'.$file.'.php');
        }
		$this->view->setModels($models);
	}
}
