<?php

namespace mvc\scratch\core;

class Request
{
    protected $uri;

    protected $entity = null;
    protected $action;
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
                    $this->controller = $value;
                } elseif ($key == "a") {
                    $this->action = $value;
                } else {
                    $this->params[$key] = $value;
                }
            }
        }

        var_dump($this->uri);
        echo PHP_EOL . ' - - - - '  . PHP_EOL;
        var_dump($this->controller);
        var_dump($this->action);
        var_dump($this->params);
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }
}