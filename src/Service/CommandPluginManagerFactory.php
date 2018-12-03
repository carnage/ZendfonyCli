<?php

namespace Carnage\ZendfonyCli\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\Config as ServiceManagerConfig;
use Interop\Container\ContainerInterface;

class CommandPluginManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $instance = new CommandPluginManager($container);

        $config = $container->get('Config');
        $commands = $config['cli_commands'];
        $config = new ServiceManagerConfig($commands);
        $config->configureServiceManager($instance);

        return $instance;
    }
}
