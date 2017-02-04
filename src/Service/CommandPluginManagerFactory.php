<?php

namespace Carnage\ZendfonyCli\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config as ServiceManagerConfig;

class CommandPluginManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $instance = new CommandPluginManager($serviceLocator);

        $config = $serviceLocator->get('Config');
        $commands = $config['cli_commands'];
        $config = new ServiceManagerConfig($commands);
        $config->configureServiceManager($instance);

        return $instance;
    }
}
