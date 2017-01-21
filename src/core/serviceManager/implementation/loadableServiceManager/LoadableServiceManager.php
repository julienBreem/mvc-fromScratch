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

namespace base\core\serviceManager\implementation\loadableServiceManager;

use base\core\serviceManager\implementation\AbstractServiceManager;
use base\core\serviceManager\ServiceNotFoundException;

/**
 * Class SimpleServiceManager
 *
 * Allow to get a service if implements loadableService
 *
 * @package base\core\serviceManager
 */
class LoadableServiceManager extends AbstractServiceManager
{
    /**
     * Return a service if it's loadable
     *
     * @param $id
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function get($id)
    {
        if (is_a($id, LoadableServiceInterface::class, true)) {
            $service = new $id();
            return $this->propagate($service);
        }
        throw new ServiceNotFoundException($id);
    }
}