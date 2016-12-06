<?php

require __DIR__ . '/vendor/autoload.php';
include('config.php');
//get the URI
$uri = isset($_SERVER['REQUEST_URI']) 
           ? $_SERVER['REQUEST_URI'] 
           : '/';
//Initializes the request abstraction from URI

$request = new base\core\request($uri);

//getting the view class from the request
$viewFactory = new base\view\ViewFactory();
$view = $viewFactory->getView($request);
$view->setDefaultTemplateLocation($config["defaultTemplateLocation"]);

//getting the data mapper from the connection string
$dataMapperFactory = new base\model\DataMapperFactory($config["connectionString"]);
$dataMapper = $dataMapperFactory->getDataMapper();

$modelService = new base\model\Service($dataMapper,$config["modelType"]);

//getting controller and feeding it the view, the request and the modelFactory.
$controllerFactory = new base\controller\ControllerFactory();
$controller = $controllerFactory->getController($request,$view,$modelService);

//Execute the necessary command on the controller 
$command = $request->getActionName();
$controller->{$command}($request);

//Produces the response
echo $view->render();
