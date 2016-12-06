<?php
namespace project\controller;

use base\controller\controller;

class site extends controller{
	
	public function  __construct($view, $modelService){
		parent::__construct($view, $modelService);
	}
	
	public function index()
	{
		$model = $this->modelService->getEntityById("table",1);
		// $model->attributes['column1'] = 'test';
		$this->render('index',['model' => $model]);
	}
}
