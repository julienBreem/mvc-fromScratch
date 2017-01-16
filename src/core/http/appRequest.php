<?php

/**
 * Created by Julien Breem.
 * Date: 12/12/2016
 * Time: 16:38
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2016
 **/

namespace base\core\http;

use GuzzleHttp\Psr7\ServerRequest;

class appRequest extends ServerRequest
{
    protected $controllerName = "site";
    protected $actionName = "index";
    protected $params = [];


    public function __construct()
    {
        parent::__construct(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            getallheaders(),
            file_get_contents('php://input'),
            $_SERVER['SERVER_PROTOCOL'],
            $_SERVER
        );

        $urlString = $this->getUri()->getQuery();
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

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @param string $controllerName
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }

    /**
     * @return array
     */
    public function getParams()
    {
       return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }
}