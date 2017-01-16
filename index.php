<?php
require __DIR__ . '/vendor/autoload.php';
include('config.php');

//Initializes the request abstraction
//$request = new base\core\request();
$request = new GuzzleHttp\Psr7\ServerRequest(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI'],
    getallheaders(),
    stream_get_contents(STDIN),
    $_SERVER['SERVER_PROTOCOL'],
    $_SERVER
);

//getting the view class from the request
$viewFactory = new base\view\ViewFactory();
$view = $viewFactory->getView($request);
$view->setDefaultTemplateLocation($config["view"]["defaultTemplateLocation"]);


$modelService = new base\model\Service($config["model"]);

//getting controller and feeding it the view, the request and the modelFactory.
$controllerFactory = new base\controller\ControllerFactory();
$controller = $controllerFactory->getController($request,$view,$modelService);

//Execute the necessary command on the controller 
$command = $request->getActionName();
$controller->{$command}($request);

//Produces the response
echo $view->render();
