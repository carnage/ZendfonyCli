<?php

namespace Carnage\ZendfonyCli\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config as ServiceManagerConfig;
use Interop\Container\ContainerInterface;

class CommandPluginManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }

    public function __invoke(ContainerInterface $container, $name, $options = [])
    {
        $instance = new CommandPluginManager($container);

        $config = $container->get('Config');
        $commands = $config['cli_commands'];
        $config = new ServiceManagerConfig($commands);
        $config->configureServiceManager($instance);

        return $instance;
    }
}
