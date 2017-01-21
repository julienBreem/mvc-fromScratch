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

namespace base\core\serviceManager\implementation\factorisableServiceManager;

use base\core\factory\ViewFactory;
use base\core\serviceManager\implementation\AbstractServiceManager;
use base\core\serviceManager\ServiceNotFoundException;
use base\view\View;

/**
 * Class FactorisableServiceManager
 *
 * Allow to get service if a factory is associated to it
 *
 * @package base\core\serviceManager\implementation\factorisableService
 */
class FactorisableServiceManager extends AbstractServiceManager
{
    /**
     * Look for an associated factory if service is a FactorisableServiceInterface
     *
     * @param $id
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function get($id)
    {
        $service = $this->getFactory($id)->build();
        return $this->propagate($service);
    }

    /**
     * Check if an associated factory exists in factory folder
     *
     * @todo Find a better way to load factories
     * @param $id
     * @return mixed
     * @throws ServiceNotFoundException
     */
    protected function getFactory($id)
    {
        $registry = $this->getFactoryRegistry();
        if (array_key_exists($id, $registry)) {
            $factory = new $registry[$id]();
            return $this->propagate($factory);
        }
        throw new ServiceNotFoundException($id);
    }

    /**
     * Map of class to its factory
     *
     * @todo Move it to config
     * @return array
     */
    protected function getFactoryRegistry()
    {
        return [
            'view' => ViewFactory::class,
        ];
    }
}