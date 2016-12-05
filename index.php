<?php
define('DS', DIRECTORY_SEPARATOR); // meilleur portabilité sur les différents systeme.
define('ROOT', dirname(__FILE__).DS); // pour se simplifier la vie
session_start();
require('classes/core/request.php');
require('classes/core/viewFactory.php');
require('classes/core/controllerFactory.php');
require('classes/core/modelFactory.php');
require('classes/core/dataMapperFactory.php');


//get the URI
$uri = isset($_SERVER['REQUEST_URI']) 
           ? $_SERVER['REQUEST_URI'] 
           : '/';
//Initializes the request abstraction from URI
$request = new core\request($uri);

//getting the view class from the request
$viewFactory = new core\viewFactory();
$view = $viewFactory->getView($request);
$view->setDefaultTemplateLocation(__DIR__ . '/templates');

//getting the data mapper from the connection string
$connectionString = "mysql:host=localhost;dbname=test;username=root;";
$dataMapperFactory = new core\dataMapperFactory($connectionString);
$dataMapper = $dataMapperFactory->getDataMapper();

$modelFactory = new core\modelFactory($dataMapper);

//getting controller and feeding it the view, the request and the modelFactory.
$controllerFactory = new core\controllerFactory();
$controller = $controllerFactory->getController($request,$view,$modelFactory);

//Execute the necessary command on the controller 
$command = $request->getCommand();
$controller->{$command}($request);

//Produces the response
echo $view->render();
?>