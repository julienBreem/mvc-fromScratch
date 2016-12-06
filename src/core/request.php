<?php

namespace base\core;

class Request
{
    protected $uri;
	protected $controllerName = "site";
	protected $actionName = "index";
    protected $params = [];

    public function __construct()
    {
        $this->uri = isset($_SERVER['REQUEST_URI'])
            ? $_SERVER['REQUEST_URI']
            : '/';

        if(strpos($this->uri, "?")) {
            $urlString = substr($this->uri, strpos($this->uri, "?") + 1);
            $urlTab = explode("&",$urlString);
            foreach($urlTab as $param) {
                $key = explode("=",$param)[0];
                $value = explode("=",$param)[1];
                if ($key == "c") {
                    $this->controllerName = $value;
                } elseif ($key == "a") {
                    $this->actionName = $value;
                } else {
                    $this->params[$key] = $value;
                }
            }
        }
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParams()
    {
        return $this->params;
    }
}