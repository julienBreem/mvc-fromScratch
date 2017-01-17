<?php
namespace project\controller;

use base\controller\controller;
class site extends controller
{	
	public function index()
	{
	    //throw new \Exception('',404);
        $physicAutoCompleted = $this->modelService->getEntityById("physicAutoCompleted",1);
        $physic = $this->modelService->getEntityById("physic",1);
        $generated = $this->modelService->getEntityById("generated",1);
        $this->render('index',
            [
                'physicAutoCompleted' => $physicAutoCompleted,
                'physic' => $physic,
                'generated' => $generated,
            ]
        );
	}

}
