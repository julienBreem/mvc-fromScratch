<?php

use base\core\factory\ViewFactory;
use base\core\Request;
use base\core\serviceManager\implementation\serviceManagerAggregator\ServiceManagerAggregator;

require __DIR__ . '/vendor/autoload.php';
include('config.php');

//Initializes the request abstraction
$request = new base\core\request();

//getting the view class from the request
//$viewFactory = new base\view\ViewFactory();
//$view = $viewFactory->getView($request);
//$view->setDefaultTemplateLocation($config["view"]["defaultTemplateLocation"]);

/**
 * Maybe chain serviceManagers will decrease performance...
 */
$serviceManager = new ServiceManagerAggregator();
$view = $serviceManager->get('view');
// ou
// $view = $serviceManager->get(ViewFactory::class)->build();

/**
 * Move it to viewFactory once configManager is done
 */
$view->setDefaultTemplateLocation($config["view"]["defaultTemplateLocation"]);



$modelService = new base\model\Service($config["model"]);

//getting controller and feeding it the view, the request and the modelFactory.
//$modelService = $serviceManager->get('Controller');

$controllerFactory = new base\controller\ControllerFactory();
$controller = $controllerFactory->getController($request,$view,$modelService);

//Execute the necessary command on the controller 
$command = $request->getActionName();
$controller->{$command}($request);

//Produces the response
echo $view->render();
