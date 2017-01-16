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

namespace base\core;

class Factory
{
    protected $namespace;
    protected $defaultClassName;

    /**
     * Factory method to build a class name
     * If built class is not a child of $defaultClassName, default class is $defaultClassName
     *
     * @param $name
     * @return $defaultClassName
     */
    public function getClassName($name)
    {
        $className = $this->buildClassName($name);
        if (! is_a($className, $this->getDefaultClassName(), true)) {
            $className = $this->getDefaultClassName();
        }
        return $className;
    }

    /**
     * Allow to change directory namespace
     *
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Build an entity className based on a name
     *
     * @param $name
     * @return string
     */
    protected function buildClassName($name)
    {
        $namespace = rtrim($this->namespace, '/\\') . '\\';
        return $namespace .$name;
    }

    /**
     * Return the default className for an entity
     *
     * @return string
     */
    protected function getDefaultClassName()
    {
        return $this->defaultClassName;
    }
}