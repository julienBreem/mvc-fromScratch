<?php
namespace controller;

require('./classes/core/controller.php');
use core\controller as controller;
class site extends controller{
	
	public function  __construct($view, $modelFactory){
		parent::__construct($view, $modelFactory);
		$this->modelFactory->setDirectory(false);
	}
	
	public function index()
	{
		$model = $this->modelFactory->buildModel("table");
		$model->attributes['column1'] = 'test';
		$this->render('index',['model' => $model]);
	}
}
?>