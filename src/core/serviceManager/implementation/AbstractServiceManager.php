<?php
/**
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

namespace base\core\serviceManager\implementation;

use base\core\serviceManager\serviceLocator\ServiceLocatorAwareInterface;
use base\core\serviceManager\serviceLocator\ServiceLocatorAwareTrait;
use base\core\serviceManager\ServiceManagerInterface;

abstract class AbstractServiceManager implements ServiceManagerInterface, ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * Propagate components to $service to chain class
     *
     * @param $service
     * @return mixed
     */
    public function propagate($service)
    {
        if (! is_object($service)) {
            return $service;
        }

        if (is_a($service, ServiceLocatorAwareInterface::class)) {
            $service->setServiceLocator($this->getServiceLocator());
        }

        return $service;
    }
}