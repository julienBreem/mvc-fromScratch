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

namespace base\core\serviceManager\implementation\serviceManagerAggregator;

use base\core\serviceManager\implementation\AbstractServiceManager;
use base\core\serviceManager\implementation\factorisableServiceManager\FactorisableServiceManager;
use base\core\serviceManager\implementation\loadableServiceManager\LoadableServiceManager;
use base\core\serviceManager\ServiceNotFoundException;
use base\core\serviceManager\ServiceManagerInterface;

class ServiceManagerAggregator extends AbstractServiceManager
{
    /**
     * ServiceManager to wrap calls
     *
     * @var ServiceManagerInterface[]
     */
    protected $serviceManagers = [];

    /**
     * ServiceManagerAggregator constructor.
     *
     * Register serviceManagers to wrap methods. Has to be sorted by priority
     */
    public function __construct()
    {
        $this->serviceManagers[] = new FactorisableServiceManager();
        $this->serviceManagers[] = new LoadableServiceManager();

        foreach ($this->serviceManagers as $serviceManager) {
            $serviceManager->setServiceLocator($this);
        }
    }

    /**
     * Call all get() of $this->serviceManagers, the first without ServiceNotFound will be returned
     *
     * @param $id
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function get($id)
    {
        foreach ($this->serviceManagers as $serviceManager) {
            try {
                return $serviceManager->get($id);
            } catch (ServiceNotFoundException $e) {
                /**
                 * @todo Add this error to a PSR7 Logger
                 */
            }
        }

        throw new ServiceNotFoundException($id);
    }

    protected function buildManager()
    {

    }
}