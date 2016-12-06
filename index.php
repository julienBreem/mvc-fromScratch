<?php

require __DIR__ . '/vendor/autoload.php';

//define('DS', DIRECTORY_SEPARATOR); // meilleur portabilité sur les différents systeme.
//define('ROOT', dirname(__FILE__).DS); // pour se simplifier la vie
//session_start();
//require_once('classes/core/request.php');
//require_once('classes/core/viewFactory.php');
//require_once('classes/core/controllerFactory.php');
//require_once('classes/service/modelService.php');
//require_once('classes/core/dataMapperFactory.php');
//config
//$config["modelType"] = "autoGen";
$config["connectionString"] = "mysql:host=localhost;dbname=test;username=root;";
$config["defaultTemplateLocation"] = __DIR__ . '/templates';

new \mvc\scratch\controller\DefaultController();

////get the URI
//$uri = isset($_SERVER['REQUEST_URI'])
//           ? $_SERVER['REQUEST_URI']
//           : '/';
//Initializes the request abstraction from URI

//$request = new core\request($uri);

//getting the view class from the request
// TO CONTROLLER
$viewFactory = new core\viewFactory();
$view = $viewFactory->getView($request);
$view->setDefaultTemplateLocation($config["defaultTemplateLocation"]);

// SERVICE::GETREPOSITORY
//getting the data mapper from the connection string
$dataMapperFactory = new core\dataMapperFactory($config["connectionString"]);
$dataMapper = $dataMapperFactory->getDataMapper();

//$modelService = new service\modelService($dataMapper,$config["modelType"]);

//getting controller and feeding it the view, the request and the modelFactory.
// == ROUTING request => controller
$controllerFactory = new core\controllerFactory();
$controller = $controllerFactory->getController($request,$view,$modelService);

//Execute the necessary command on the controller 
$command = $request->getCommand();
$controller->{$command}($request);

//Produces the response
// CONTROLLER::PROCESSRESPONSE
echo $view->render();
