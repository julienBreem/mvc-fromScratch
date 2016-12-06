<?php
namespace project\controller;

use base\controller\controller;

class site extends controller
{	
	public function index()
	{
		$model = $this->modelService->getEntityById("table",1);
		$this->render('index',['model' => $model]);
	}
}
