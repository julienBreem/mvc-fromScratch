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

namespace base\core\serviceManager\implementation\ConfigurableServiceManager;

use base\core\serviceManager\implementation\AbstractServiceManager;

class ConfigurableService extends AbstractServiceManager
{
    public function get($id)
    {
//        if (is_a($id, ConfigurableServiceInterface::class, true)) {
//            $config = $this->getConfigurationManager()->getConfig($id);
//            $service = new GenericConfigurable($config);
//
//            -- OU --
//
//            $config = $this->getConfigurationManager()->getConfig($id);
//            if (isset($config['class'])) {
//                $service = new $config['class']($config);
//            }
//
//            return $service;
//        }
    }

//    protected function getConfigurationManager();
}