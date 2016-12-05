<?php
namespace controller;

require_once('./classes/core/controller.php');
use core\controller as controller;
class site extends controller{
	
	public function  __construct($view, $modelService){
		parent::__construct($view, $modelService);
	}
	
	public function index()
	{
		$model = $this->modelService->getModelById("table",1);
		// $model->attributes['column1'] = 'test';
		$this->render('index',['model' => $model]);
	}
}
