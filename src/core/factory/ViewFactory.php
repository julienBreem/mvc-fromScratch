<?php

namespace base\core\factory;

use base\core\Request;
use base\core\serviceManager\implementation\loadableServiceManager\LoadableServiceInterface;
use base\core\serviceManager\serviceLocator\ServiceLocatorAwareInterface;
use base\core\serviceManager\serviceLocator\ServiceLocatorAwareTrait;
use base\core\serviceManager\ServiceNotFoundException;

class ViewFactory implements FactoryInterface, LoadableServiceInterface, ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $namespace = 'project\\view\\';

    public function __construct()
    {
    }

    /**
     * Build the controller associated to the Request params
     *
     * @todo Add a router between request and getControllerName?
     *
     * @todo Do not create Request here:
     *  - pass it as params via ServiceManager?
     *  - Use middleware?
     *  - Use container to handle all components (Request, View, Controller, Session...)
     *  - Use "sessionBag" passed to all components
     *  - Does request is needed here or it's just to have route?
     *
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function build()
    {
        try {
            $request = $this->getServiceLocator()->get(Request::class);
        } catch (ServiceNotFoundException $e) {
            die($e->getMessage());
        }

        $class = $this->namespace . $request->getControllerName();

        if (! class_exists($class)) {
            throw new ServiceNotFoundException($class);
        }
        return $this->getServiceLocator()->propagate(new $class());
    }
}