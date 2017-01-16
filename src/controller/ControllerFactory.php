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
namespace base\controller;

use base\core\Factory;

class controllerFactory extends Factory
{
	protected $namespace = "project\\controller";
    protected $defaultClassName = Controller::class;
    protected $mainClass = Controller::class;

	public function getController( $request, $view, $modelService )
	{
		$class = $this->getClassName($request->getControllerName());
		$controller = new $class($view, $modelService);
		$controller->setName($request->getControllerName());
		return $controller;
	}
}

